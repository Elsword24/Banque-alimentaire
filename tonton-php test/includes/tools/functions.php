<?php

if (!function_exists('connexion')) {

    function connexion()
    {
        $host = 'localhost';             //myHostAddress
        $dbuser = 'gefr1116_tonton';     //myUserName
        $dbpw = 'tonton_a_la_plage';     //myPassword
        $dbname = 'gefr1116_tonton';     //myDatabase

        $pdoReqArg1 = "mysql:host=". $host .";dbname=". $dbname .";";
        $pdoReqArg2 = $dbuser;
        $pdoReqArg3 = $dbpw;

        try {

            $db = new \PDO($pdoReqArg1, $pdoReqArg2, $pdoReqArg3);
            $db->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
            $db->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES 'utf8'");

            return $db;

        } catch(\PDOException $e) {

            $errorMessage = $e->getMessage();
            echo $errorMessage;
        }
    }
}

if (!function_exists('get_page')) {

    function get_page($uri, $segments)
    {
        if (!isset($segments[2])) {

            switch ($uri) {

                case '/':
                    ob_start();
                    include __REALPATH__ . '/includes/home.php';
                    $content = ob_get_clean();
                    break;

                case '/a-propos':
                    ob_start();
                    include __REALPATH__ . '/includes/about.php';
                    $content = ob_get_clean();
                    break;

                case '/blog':
                    ob_start();
                    include __REALPATH__ . '/includes/blog.php';
                    $content = ob_get_clean();
                    break;

                case '/contact':
                    ob_start();
                    include __REALPATH__ . '/includes/contact.php';
                    $content = ob_get_clean();
                    break;

                case '/mentions-legales':
                    ob_start();
                    include __REALPATH__ . '/includes/mentions-legales.php';
                    $content = ob_get_clean();
                    break;

                case '/rgpd':
                    ob_start();
                    include __REALPATH__ . '/includes/rgpd.php';
                    $content = ob_get_clean();
                    break;

                case '/cgu':
                    ob_start();
                    include __REALPATH__ . '/includes/cgu.php';
                    $content = ob_get_clean();
                    break;

                case '/login':
                    define('ADMIN', true);
                    ob_start();
                    include __REALPATH__ . '/includes/admin/login.php';
                    $content = ob_get_clean();
                    break;

                case '/admin':
                    define('ADMIN', true);
                    ob_start();
                    include __REALPATH__ . '/includes/admin/admin.php';
                    $content = ob_get_clean();
                    break;

                default:
                    define('ERROR_404', true);
                    ob_start();
                    include __REALPATH__ . '/includes/404.php';
                    $content = ob_get_clean();
                    http_response_code(404);
                    break;
            }

        } else if (isset($segments[2]) && $segments[1] == 'blog') {

            $content = blog_dispatcher($segments);

        } else if (isset($segments[2]) && $segments[1] == 'admin') {

            define('ADMIN', true);

            switch ($segments[2]) {

                case 'messages':
                    ob_start();
                    include __REALPATH__ . '/includes/admin/messages.php';
                    $content = ob_get_clean();
                    break;

                case 'articles':
                    ob_start();
                    include __REALPATH__ . '/includes/admin/articles.php';
                    $content = ob_get_clean();
                    break;

                case 'users':
                    ob_start();
                    include __REALPATH__ . '/includes/admin/users.php';
                    $content = ob_get_clean();
                    break;

                default:
                    define('ERROR_404', true);
                    ob_start();
                    include __REALPATH__ . '/includes/404.php';
                    $content = ob_get_clean();
                    http_response_code(404);
                    break;
            }
        }

        return $content;
    }
}

if (!function_exists('blog_dispatcher')) {
    
    function blog_dispatcher($segments)
    {
        $name = $segments[2];
        $article = getOneArticle($name);
        if (!empty($article)) {

            ob_start();
            include __REALPATH__ . '/includes/common/article.php';
            return ob_get_clean();

        } else {

            define('ERROR_404', true);
            ob_start();
            include __REALPATH__ . '/includes/404.php';
            $content = ob_get_clean();
            http_response_code(404);
            return $content;
        }
    }
}

if (!function_exists('maintenance')) {

    function maintenance()
    {
        $ip = [
            '90.50.145.182', // Fred
            '92.184.110.182', // Temporaire
            '109.214.144.207', // Tristan
            '86.213.50.181' // Clément
        ];

        if ((isset($_SERVER['HTTP_X_FORWARDED_FOR']) && in_array($_SERVER['HTTP_X_FORWARDED_FOR'], $ip))
            || (isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], $ip))) {

            return true;

        } else {

            define('MAINTENANCE', true);
            require __REALPATH__ . '/includes/common/head.php';
            require __REALPATH__ . '/includes/maintenance.php';
            require __REALPATH__ . '/includes/common/footer.php';
            exit();
        }
    }
}

if (!function_exists('getArticles')) {

    function getArticles()
    {
        $db = connexion();
        $query = "SELECT * FROM articles WHERE published = 1";
        $stt = $db->prepare($query);
        $stt->execute();
        $articles = $stt->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }
}

if (!function_exists('getOneArticle')) {

    function getOneArticle($uri)
    {
        $db = connexion();
        $query = "SELECT * FROM articles WHERE uri = '" . $uri . "' AND published = 1";
        $stt = $db->prepare($query);
        $stt->execute();
        $article = $stt->fetch(\PDO::FETCH_ASSOC);
        return $article;
    }
}

if (!function_exists('formatDate')) {

    function formatDate($date)
    {
        $d = date("d-m-Y", strtotime($date));
        $t = date("H\hi", strtotime($date));
        return $d . ' à ' . $t;
    }
}

if (!function_exists('isAdmin')) {

    function isAdmin()
    {
        if (!isset($_SESSION['id']) && isset($_POST['connexion']) && $_POST['connexion'] == 'ok') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $db = connexion();
            $query = "SELECT id, firstname, lastname, email FROM users WHERE email = '" . $email . "' AND password = '" . md5($password) . "'";
            $stt = $db->prepare($query);
            $stt->execute();

            if ($stt->rowCount() > 0) {

                $user = $stt->fetch(\PDO::FETCH_ASSOC);
                foreach ($user as $key => $value) {

                    $_SESSION[$key] = $value;
                    header('Location: ' . DOMAIN . '/admin');
                }
            }
        }
    }
}

if (!function_exists('logout')) {

    function logout()
    {
        if (isset($_POST['logout']) && $_POST['logout'] == 'ok') {
            session_destroy();
            header('Location: ' . DOMAIN . '/login');
        }
    }
}

if (!function_exists('getMessage')) {

    function getMessage()
    {
        if (isset($_POST['subject']) && isset($_POST['email']) && isset($_POST['message'])) {

            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            try {

                $db = connexion();
                $query = "INSERT INTO `messages`(`email`, `sujet`, `message`) VALUES (:email, :subject, :message)";
                $stt = $db->prepare($query);
                $stt->bindValue(':email', $email, PDO::PARAM_STR);
                $stt->bindValue(':subject', $subject, PDO::PARAM_STR);
                $stt->bindValue(':message', $message, PDO::PARAM_STR);
                $stt->execute();

                return '<div class="message-statement message-ok"><p>Le message a bien été envoyé</p></div>';

            } catch(PDOException $e) {

                return '<div class="message-statement message-nok"><p>Une erreur s\'est produite, veuillez réessyer...</p></div>';
            }
        }
    }
}

if (!function_exists('crudBuilder')) {

    function crudBuilder($table)
    {
        if ($table == 'articles') {

            $array = [
                'id' => 'id',
                'uri' => 'permalien',
                'title' => 'titre',
                'author' => 'auteur',
                'content' => 'corps du texte',
                'image' => 'image',
                'published' => 'publié',
                'created_at' => 'créé le'
            ];

        } else if ($table == 'messages') {

            $array = [
                'id' => 'id',
                'email' => 'email',
                'sujet' => 'sujet',
                'message' => 'message',
                'created_at' => 'créé le'
            ];

        } else if ($table == 'users') {

            $array = [
                'id' => 'id',
                'firstname' => 'prénom',
                'lastname' => 'nom',
                'email' => 'email',
                'created_at' => 'créé le'
            ];
        }

        $db = connexion();
        $query = "SELECT * FROM " . $table;
        $stt = $db->prepare($query);
        $stt->execute();
        $results = $stt->fetchAll(\PDO::FETCH_ASSOC);
        return [$results, $array];
    }
}

if (!function_exists('crudMode')) {

    function crudMode($uri)
    {
        if (isset($_GET['mode']) && !empty($_GET['mode'])) {

            $mode = $_GET['mode'];

            if ($mode == 'read' || $mode == 'edit') {

                $id = $_GET['id'];
                $table = explode('/', $uri)[2];
                $db = connexion();
                $query = "SELECT * FROM " . $table . " WHERE id = " . intval($id);
                $stt = $db->prepare($query);
                $stt->execute();
                $result = $stt->fetch(\PDO::FETCH_ASSOC);
                return $result;

            } else if ($mode == 'delete') {

                $id = $_GET['id'];
                $table = explode('/', $uri)[2];
                $db = connexion();
                $query = "DELETE FROM " . $table . " WHERE id = " . intval($id);
                $stt = $db->prepare($query);
                $stt->execute();
                header('Location: ' . $uri);
            }
        }
    }
}

if (!function_exists('recordCrud')) {

    function recordCrud($uri)
    {
        if (isset($_POST['new']) && $_POST['new'] == 'ok') {

            $table = explode('/', $uri)[2];
            $db = connexion();

            if ($table == 'articles') {

                $query = "INSERT INTO `articles` (`uri`, `title`, `author`, `content`, `image`, `published`) VALUES (:uri, :title, :author, :content, :image, :published)";
                $stt = $db->prepare($query);
                $stt->bindValue(':uri', $_POST['uri'], PDO::PARAM_STR);
                $stt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
                $stt->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
                $stt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
                $stt->bindValue(':image', $_FILES["image"]["name"], PDO::PARAM_STR);
                $stt->bindValue(':published', $_POST['published'], PDO::PARAM_INT);
                $stt->execute();

                if (move_uploaded_file($_FILES["image"]["tmp_name"], __REALPATH__ . '/assets/media/images/' . $_FILES["image"]["name"])) {
                    return true;
                }

            } else if ($table == 'users') {

                $query = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password)";
                $stt = $db->prepare($query);
                $stt->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                $stt->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                $stt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $stt->bindValue(':password', md5($_POST['password']), PDO::PARAM_STR);
                $stt->execute();
            }

            header('Location: ' . $uri);

        }

        if (isset($_POST['edit']) && $_POST['edit'] == 'ok') {

            $table = explode('/', $uri)[2];
            $db = connexion();

            if ($table == 'articles') {

                $query = "UPDATE `articles` SET `uri` = :uri, `title` = :title, `author` = :author, `content` = :content, `image` = :image, `published` = :published WHERE id = " . $_POST['id'];
                $stt = $db->prepare($query);
                $stt->bindValue(':uri', $_POST['uri'], PDO::PARAM_STR);
                $stt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
                $stt->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
                $stt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
                $stt->bindValue(':image', $_FILES["image"]["name"], PDO::PARAM_STR);
                $stt->bindValue(':published', $_POST['published'], PDO::PARAM_INT);
                $stt->execute();

                if (move_uploaded_file($_FILES["image"]["tmp_name"], __REALPATH__ . '/assets/media/images/'. $_FILES["image"]["name"])) {
                    return true;
                }

                header('Location: ' . $uri);

            } else if ($table == 'users') {

                if (isset($_POST['password']) && !empty($_POST['password'])) {

                    $query = "UPDATE `users` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = :password WHERE id = " . $_POST['id'];
                    $stt = $db->prepare($query);
                    $stt->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                    $stt->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                    $stt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                    $stt->bindValue(':password', md5($_POST['password']), PDO::PARAM_STR);
                    $stt->execute();

                } else {

                    $query = "UPDATE `users` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email WHERE id = " . $_POST['id'];
                    $stt = $db->prepare($query);
                    $stt->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                    $stt->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                    $stt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                    $stt->execute();
                }

                header('Location: ' . $uri);

            }

        }
    }
}
