<?php if (!isset($isTools)) { $isTools=false; };
if (!isset($isLogin)) { $isLogin=false; };
if (!isset($_SESSION['login'])) { $_SESSION['login']=false; }; ?>
<nav class="header">
	<div class="leftHeader">
		<a href="home.php"><img src="../images/c2su.png" alt="Logo de la corpo" class="logoHeader"></a>
	</div>
	<div class="middleHeader">
		<?php if ($isTools):?>
		<a class="retour" href="tools.php" style="text-decoration:none"><h1 class="welcome">Bienvenue sur le TOOLS</h1></a>
		<?php else : ?>
		<a class="retour" href="tools.php" style="text-decoration:none"><h1 class="welcome">Retourner sur le TOOLS</h1></a>
		<?php endif; ?>
	</div>
		<?php if (!$isLogin): ?>
			<?php if (!$_SESSION['login']) : ?><a href='login.php' style="text-decoration:none"><div class="rightHeader"><p class="loginHeader">Connexion</p></div></a>
			<?php else: ?><div class="rightHeader"><a class="loginHeader" href="deco.php">Déconnexion</a></div> <?php endif;?>
		<?php else: ?>
		<div class="rightHeader"><a class="loginHeader" href="../php/register.php">Inscription</a></div>
		<?php endif; ?>
</nav>
