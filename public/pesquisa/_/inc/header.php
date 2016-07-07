<?php
$menu = array(
    array(
        'title' => 'Sobre a pesquisa',
        'slug' => 'sobre-a-pesquisa'
    ),
    array(
        'title' => 'Dia a dia',
        'slug' => 'dia-a-dia'
    ),
    array(
        'title' => 'Trabalho remunerado',
        'slug' => 'trabalho-remunerado'
    ),
    array(
        'title' => 'Trabalho doméstico',
        'slug' => 'trabalho-domestico'
    ),
    array(
        'title' => 'Demandas e preocupações',
        'slug' => 'demandas-e-preocupacoes'
    )
);

?>

<header class="main-header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">Menu</button>
        </div>

    </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse main-header-links" id="main-nav">
            <div class="container">
                <ul class="nav navbar-nav">
                    <?php foreach ($menu as $m): ?>
                        <li><a href="<?php echo BASE_URL ?>/?page=<?php echo $m['slug']; ?>" title="<?php echo $m['title']; ?>"><?php echo $m['title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
</header>
