<?php

    class Connection {

        private static $connection;

        public static function connect() {
            if (!self::$connection) {
                mysqli_report(MYSQLI_REPORT_OFF);
                
                self::$connection = mysqli_connect(
                    Application::$conf['host'],
                    Application::$conf['login'], 
                    Application::$conf['password'],
                    Application::$conf['database']
                );

                if (mysqli_connect_error()) {
                    echo mysqli_connect_error();
                }
            }

            return self::$connection;
        }

        public static function query($query, $result_mode = MYSQLI_STORE_RESULT) {
            self::connect();

            if (self::$connection) {
                $result = mysqli_query(self::$connection, $query, $result_mode);

                if (mysqli_error(self::$connection)) {
                    echo mysqli_error(self::$connection) . "\n\n";

                    echo $query;
                }
            }

            return $result;
        }

        public static function insert($table, $row, $update = false) {
            return self::insertBatch($table, array_keys($row), [$row], $update);
        }

        public static function insertBatch($table, $columns, $rows, $update = false) {
            $columnsString = implode(', ', $columns);
            
            $rowsList = [];

            foreach ($rows as $row) {
                foreach ($row as &$value) {
                    if ($value == '') {
                        $value = 'null';

                        continue;
                    }

                    if ($value == (float)$value) {
                        continue;
                    }

                    $value = '\'' . self::escape_string($value) . '\'';
                }

                $rowsList[] = '(' . implode(', ', $row) . ')';
            }

            $rowsString = implode(', ', $rowsList);

            $query = "insert into `$table` ($columnsString) values $rowsString";

            $updateList = [];

            if ($update) {
                $updateList = [];

                foreach ($columns as $column) {
                    $updateList[] = $column . ' = values(' . $column . ')';
                }

                $updateString = implode(', ', $updateList);

                $query .= ' on duplicate key update ' . $updateString;
            }

            return self::query($query);
        }

        public static function escape_string($string) {
            return mysqli_real_escape_string(self::connect(), $string);
        }

        public static function getAffectedRows() {
            return mysqli_affected_rows(self::connect());
        }

        public static function getInsertId() {
            return mysqli_insert_id(self::connect());
        }
    }
