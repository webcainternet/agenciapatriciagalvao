<section class="page-step s5-domestic-work" data-step="5">

    <div class="step-header">
        <div class="container">
            <div class="lettering">
                <h1 class="step-title">Trabalho doméstico</h1>
                <p class="step-subtitle tablet-subtitle">Clique a arraste os ícones aos responsáveis por cada um dos afazeres domésticos listados.<br>Caso você tenha um(a) empregado(a) doméstico(a), arraste para o campo específico.</p>
                <p class="step-subtitle mobile-subtitle">Clique nos responsáveis para abrir a janela com os afazeres domésticos.</p>
            </div>
        </div>

         <div class="header-img">
            <img src="images/header-img-6.jpg" alt="">
        </div>

    </div>

    <div class="step-content">
        <div class="container">

            <!-- tablet and desktop selector start -->
            <div class="tablet-selector">
                <div class="tablet-selector-header">
                    <!-- Nav tabs start -->
                    <ul class="nav nav-tabs">
                        <?php $is_first = true; ?>
                        <?php foreach ($activities_array as $activity): ?>
                            <?php
                                $li_class = ($is_first) ? 'active' : '';
                                $is_first = false;
                            ?>
                            <li class="<?php echo $li_class; ?>"><a href="#tab-<?php echo $activity['key']; ?>" data-toggle="tab"><?php echo $activity['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Nav tabs end -->

                    <!-- tab contents start -->
                    <div class="tab-content">
                        <?php $is_first = true; ?>
                        <?php foreach ($activities_array as $activity): ?>
                            <?php
                                $div_class = ($is_first) ? 'active ' : '';
                                $is_first = false;

                                $div_class .= 'tab-pane fade in';
                            ?>
                            <div class="<?php echo $div_class; ?>" id="tab-<?php echo $activity['key']; ?>">
                                <ul>
                                    <?php foreach ($activity['items'] as $item): ?>
                                        <li>
                                            <div class="ico draggable action-<?php echo $item['key']; ?>" data-key="<?php echo $item['key']; ?>">
                                                <img src="images/<?php echo $item['icon']; ?>" alt="<?php echo $item['title']; ?>" class="ico ico-<?php echo $item['key']; ?>">
                                            </div>

                                            <span class="icon-title"><?php echo $item['title']; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- tab contents end -->
                </div>

                <div class="people-drawers">
                    <a class="user-area" href="#" title="" data-id="user">
                        <div class="user-info">
                            <span class="i-smiley2 user-color"></span>
                            <span class="user-name"></span>
                        </div>
                        <div class="user-icon-drawer clearfix"></div>
                    </a>
                </div>
            </div>
            <!-- tablet and desktop selector end -->

            <!-- mobile selector start -->
            <div class="mobile-selector">

                <div class="people-drawers">
                    <a class="user-area row" href="#" title="" data-toggle="modal" data-target="#modalIconSelector" data-id="user">
                        <div class="user-info">
                            <span class="i-smiley2 user-color"></span>
                            <span class="user-name"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- mobile selector end -->
    </div>

    <!-- nav buttons start -->
    <nav class="nav-buttons">
        <div class="container">
            <button type="stepper" class="btn-press btn-back" data-step="4">
                <span class="i-arrow-left2"></span>
                <span class="button-text">Anterior</span>
            </button>
            <button type="result_calc" class="btn-press btn-start center-block">
                <span class="button-text">Ver resultado!</span>
                <span class="i-arrow-right2"></span>
            </button>
        </div>
    </nav>
    <!--nav buttons end -->

    <!-- footer start -->
   <div class="terms-privacy">
        <a href="#"  data-toggle="modal" data-target="#modalTerms" title="Termos de Uso">Termos de Uso</a>
        <a href="#" data-toggle="modal" data-target="#modalPrivacy" title="Política de Privacidade">Política de Privacidade</a>
    </div>
    <!-- footer end -->

</section>
