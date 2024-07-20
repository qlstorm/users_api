<?php

    class Users {

        public static function runAPI($params) {
            $param = $params[0];

            if (!$param) {
                return Users::getList();
            }

            if ((int)$param == $param) {
                return Users::get($param);
            }

            call_user_func('Users::' . $param, $params);
        }

        public static function add() {
            Connection::insert('users', $_POST);
        }

        public static function update() {
            Connection::insert('users', $_POST, true);
        }

        public static function delete($id) {
            Connection::query('
                delete from users
                where
                    id = ' . (int)$id
            );

            echo Connection::getAffectedRows();
        }

        public static function auth($login, $password) {
            $result = Connection::query('
                select id, auth_key from users
                where
                    login = ' . Connection::escape_string($login) . ' and
                    password = ' . Connection::escape_string($password)
            );

            $user = $result->fetch_assoc();

            if ($user) {
                setcookie('id', $user['id'], 0, '/');
                setcookie('auth_key', $user['auth_key'], 0, '/');
            }
        }

        public static function get($id) {
            $result = Connection::query('
                select * from users
                where
                    id = ' . (int)$id
            );

            echo json_encode($result->fetch_assoc());
        }

        public static function getList() {
            $result = Connection::query('
                select * from users
                limit 10
            ');

            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
    }
