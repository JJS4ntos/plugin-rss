<div class="wrap">
	<h1>Importador de Feed</h1>
	<p>Projeto desenvolvido sob medida para Pasquale Laviano.</p>
	<h2 class="nav-tab-wrapper">
		<a href="<?= admin_url('admin.php?page=rsswkimporter') ?>" class="nav-tab <?= $_GET['page'] == 'rsswkimporter' ? 'nav-tab-active' : ''; ?>">Painel</a>
		<a href="<?= admin_url('admin.php?page=rss-wk-agb') ?>" class="nav-tab <?= $_GET['page'] == 'rss-wk-agb' ? 'nav-tab-active' : ''; ?>">Agência Brasil</a>
		<a href="<?= admin_url('admin.php?page=rss-wk-arp') ?>" class="nav-tab <?= $_GET['page'] == 'rss-wk-arp' ? 'nav-tab-active' : ''; ?>">Arena do Pavini</a>
		<a href="<?= admin_url('admin.php?page=rss-wk-inv') ?>" class="nav-tab <?= $_GET['page'] == 'rss-wk-inv' ? 'nav-tab-active' : ''; ?>">Investing</a>
	</h2>
	<div class="tabs-content">
		@yield('content')
	</div>
</div>
