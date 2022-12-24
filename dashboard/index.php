<?php
error_reporting(0);

require '../keyauth.php';
require '../credentials.php';

session_start();

if (!isset($_SESSION['user_data'])) // if user not logged in
{
    header("Location: ../");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

function findSubscription($name, $list)
{
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i]->subscription == $name) {
            return true;
        }
    }
    return false;
}

$username = $_SESSION["user_data"]["username"];
$subscriptions = $_SESSION["user_data"]["subscriptions"];
$subscription = $_SESSION["user_data"]["subscriptions"][0]->subscription;
$expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}
?>
<html lang="en">

<head>
    <title>Dashboard</title>
    <script src="https://cdn.keyauth.win/dashboard/unixtolocal.js"></script>
	<link href="css/plugins.bundle.css" rel="stylesheet" type="text/css">
	<link href="css/style.bundle.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-dark">
<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
			<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
				<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
					<form class="form w-100" method="post">
						<div class="text-center mb-10">
							<h1 class="text-light mb-3">Logged in as <?php echo $username; ?></h1>
						</div>

						<div class="fv-row mb-10">
							<div class="text-center">
							<form method="post">
								<button name="logout" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Logout</span>
								</button>
								</form>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
#region Extra Functions
/*
//* Get Public Variable
$var = $KeyAuthApp->var("varName");
echo "Variable Data: " . $var;
//* Get User Variable
$var = $KeyAuthApp->getvar("varName");
echo "Variable Data: " . $var;
//* Set Up User Variable
$KeyAuthApp->setvar("varName", "varData");
//* Log Something to the KeyAuth webhook that you have set up on app settings
$KeyAuthApp->log("message");
//* Basic Webhook with params
$result = $KeyAuthApp->webhook("WebhookID", "&type=add&expiry=1&mask=XXXXXX-XXXXXX-XXXXXX-XXXXXX-XXXXXX-XXXXXX&level=1&amount=1&format=text");
echo "<br> Result from Webhook: " . $result;
//* Webhook with body and content type
$result = $KeyAuthApp->webhook("WebhookID", "", "{\"content\": \"webhook message here\",\"embeds\": null}", "application/json");
echo "<br> Result from Webhook: " . $result;
//* If first sub is what ever then run code
if ($subscription === "Premium") {
	Premium Subscription Code ...
}
*/
#endregion
?>