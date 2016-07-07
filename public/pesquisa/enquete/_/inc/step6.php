<section class="page-step s6-result" data-step="6">

    <div class="step-header">
        <div class="container">
            <div class="lettering">
                <hgroup>
                    <h1 class="step-title result-title"></h1>
                    <h2 class="step-subtitle result-subtitle"></h2>
                    <h3 class="step-subtitle result-subsubtitle"></h3>
                </hgroup>
            </div>
        </div>

        <div class="header-img">
            <img src="images/header-img-7.jpg" alt="">
        </div>
    </div>

    <div class="step-content">
        <div class="container">
            <div class="row">
                <div class="result-text col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="plotted-result">
                        <p><strong>Escala de trabalho</strong> <a href="#" class="form-view-helper" data-toggle="tooltip" title="Passe o mouse por cima das barras para ver a distribuição de horas">?</a></p>
                    </div>
                    <p><strong>Divisão do trabalho doméstico</strong>
                    <div id="work-division-chart"></div>
                </div>
            </div>

            <div class="share-tools">
                <h3 class="share-title info-text"></h3>
                <div class="share-links">
                    <a href="https://www.facebook.com/dialog/feed?display=popup&app_id=<?php echo $fb_id; ?>&link=<?php echo urlencode(BASE_URL); ?>&picture=<?php echo $site_thumbnail; ?>&name=<?php echo urlencode($title); ?>&description=<?php echo urlencode($description . '#igualdadeemcasa'); ?>&redirect_uri=<?php echo urlencode(BASE_URL); ?>" class="i-facebook2" title="facebook"></a>
                    <a href="https://twitter.com/share?url=<?php echo urlencode(BASE_URL); ?>&text=<?php echo urlencode($title . '#igualdadeemcasa'); ?>" class="i-twitter2" title="twitter"></a>
                    <a href="https://plus.google.com/share?url=<?php echo urlencode(BASE_URL); ?>" class="i-google-plus3" title="google plus"></a>
                    <a href="mailto:?body=<?php echo urlencode($description) . ": " . urlencode(BASE_URL); ?>&subject=<?php echo urlencode($title); ?>" class="i-mail2" title="email" target="_blank"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- footer start -->
    <footer class="main-footer">
        <a class="btn-press btn-back center-block" href="<?php echo BASE_URL; ?>" title="Voltar para o começo da enquete.">Voltar para o começo!</a>
        <a class="btn-press btn-study center-block" href="http://agenciapatriciagalvao.org.br/pesquisa/" title="Veja a pesquisa completa!">Veja a pesquisa completa!</a>


        <div class="terms-privacy">
            <a href="#"  data-toggle="modal" data-target="#modalTerms" title="Termos de Uso">Termos de Uso</a>

            <a href="#" data-toggle="modal" data-target="#modalPrivacy" title="Política de Privacidade">Política de Privacidade</a>
        </div>
    </footer>
    <!-- footer end -->

</section>
