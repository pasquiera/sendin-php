<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ma page de test</title>
    <link href="style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0c56e7a399.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
    <div class="icon"><i class="fa-regular fa-envelope"></i></div>
    <div class="content">
        <header>Rejoignez notre Newsletter !</header>
        <p>Inscrivez-vous à notre newsletter pour recevoir toutes nos offres spéciales.</p>
    </div>
    <form action="index.php" method="POST">

        <?php
        require_once(__DIR__ . '/vendor/autoload.php');

        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
            new GuzzleHttp\Client(),
            $credentials
        );

        $userEmail = "";
        if(isset($_POST['subscribe'])){
            $userEmail = $_POST['email'];

            if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
                $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
                $createContact['email'] = $userEmail;
                $createContact['listIds'] = [1];

                try {
                    $result = $apiInstance->createContact($createContact);
                } catch (Exception $e) {
                    echo '';
                }

                ?>
                <div class="alert success">Merci de vous être abonné à la newsletter !</div>
                <?php
            } else {
                ?>
                <div class="alert error">Adresse email invalide</div>
                <?php
            }
        }
        ?>

        <div class="field text-field">
            <input type="text" name="email" placeholder="Votre adresse email" required>
        </div>
        <div class="field btn">
            <input type="submit" name="subscribe" value="S'abonner">
        </div>
    </form>
    <div class="text">Nous ne partagerons pas vos informations à des fins commerciales.</div>
</div>

</body>
</html>