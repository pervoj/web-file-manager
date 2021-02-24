<?php
    function isPassValid($username, $password) {
        $users = parse_ini_file('wfm/admin/users/.htusers');
        return ((isset($users[$username]) && password_verify($password, $users[$username])) || (isset($users['%' . $username . '%']) && $users['%' . $username . '%'] == $password));
    }

    function getUserRole($username) {
        $userroles = parse_ini_file('wfm/admin/users/.htuserroles');
        return $userroles[$username];
    }

    function getRolePrivileges($rolename) {
        $roles = parse_ini_file('wfm/admin/users/.htroles');
        return $roles[$rolename];
    }

    function canRoleDo($rolename, $action) {
        $actions = array(
            'users' => 0,
            'delete' => 1,
            'move' => 2,
            'rename' => 3,
            'dirs' => 4,
            'upload' => 5,
        );
        $privileges = getRolePrivileges($rolename);
        if ($privileges[$actions[$action]] == 0) {
            return false;
        } else {
            return true;
        }
    }

    function getUserPrivileges($user) {
        return getRolePrivileges(getUserRole($user));
    }

    function canUserDo($user, $action) {
        return canRoleDo(getUserRole($user), $action);
    }
