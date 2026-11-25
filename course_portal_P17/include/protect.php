<?php
if (session_id() === '') {
    session_start();
}

function require_login($allowed_roles = null)
{
    if (!isset($_SESSION['uname']) || $_SESSION['uname'] === '') {
        header("Location: index.php");
        exit;
    }

    if ($allowed_roles !== null) {
        $roles = is_array($allowed_roles) ? $allowed_roles : array($allowed_roles);
        $current_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        if (!in_array($current_role, $roles, true)) {
            if ($current_role === 'admin') {
                header("Location: admin.php");
            } elseif ($current_role === 'staff') {
                header("Location: view_student1.php");
            } elseif ($current_role === 'student') {
                header("Location: userhome.php");
            } else {
                header("Location: index.php");
            }
            exit;
        }
    }
}
?>
