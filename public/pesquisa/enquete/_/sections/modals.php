<!-- icon selector modal start -->
<div class="modal fade" id="modalIconSelector" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Toque nos ícones para adicioná-los às suas atividades</h4>
            </div>
            <ul class="icon-drawer">
                <?php foreach ($activities_array as $activity): ?>
                    <li class="drawer-section-<?php echo $activity['key']; ?>">
                        <h5><?php echo $activity['title']; ?></h5>
                        <ul>
                            <?php foreach ($activity['items'] as $item): ?>
                                <li>
                                    <div class="ico action-<?php echo $item['key']; ?> ico-wrapper">
                                        <img src="images/<?php echo $item['icon']; ?>" alt="<?php echo $item['title']; ?>" class="ico ico-<?php echo $item['key']; ?>">
                                        <span class="icon-title"><?php echo $item['title']; ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<!-- icon selector modal end -->

<!-- loading screen start -->
<div class="loading-modal">
    <div class="loading-wrapper">
        <div class="loading-text">
            <span class="current-loading-text">Recolhendo dados...</span>
        </div>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">1%</span>
            </div>
        </div>
    </div>
</div>
<!-- loading screen end -->

<!-- termos de uso start -->
<div class="modal fade" id="modalTerms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <section class="subchapter">
                <h1 class="subchapter-title">Termos de uso</h1>

                <p class="first-p">A Agência Patrícia Galvão é uma iniciativa do Instituto Patrícia Galvão, criada em 2009 para atuar na produção de notícias e conteúdos sobre os direitos das mulheres brasileiras.</p>

                <p class="first-p">Todo e qualquer conteúdo produzido pela Agência Patrícia Galvão pode ser reproduzido livremente e sem custos, desde que citada a fonte/autoria, que deve incluir o nome do autor da foto, vídeo, áudio e/ou texto, bem como o da instituição e, quando possível, o link para a página em que o conteúdo foi originalmente publicado.</p>

                <h3 class="subchapter-subtitle">A licença adotada é a Creative Commons 3.0, que estabelece que:</h3>

                <h4>O usuário tem o direito de:</h4>
                <p>Compartilhar — copiar e redistribuir o material em qualquer suporte ou formato.</p>

                </p>Adaptar — remixar, transformar e criar a partir do material para qualquer fim, mesmo que comercial. O licenciante não pode revogar estes direitos desde que você respeite os termos da licença.</p>

                <h4>De acordo com os termos seguintes:</h4>
                <p class="first-p">Atribuição: você deve atribuir o devido crédito, fornecer um link para a licença e indicar se forem feitas alterações. Você pode fazê-lo de qualquer forma razoável, mas não de uma forma que sugira que o licenciante o apoia ou aprova o seu uso.</p>

                <p class="first-p">Sem restrições adicionais — você não pode aplicar termos jurídicos ou medidas de caráter tecnológico que restrinjam legalmente outros de fazerem algo que a licença permita.</p>

                <h4>Avisos:</h4>
                <p class="first-p">Você não tem de cumprir com os termos da licença relativamente a elementos do material que estejam no domínio público ou cuja utilização seja permitida por uma exceção ou limitação que seja aplicável.</p>

                <p class="first-p">Não são dadas quaisquer garantias. A licença pode não lhe dar todas as</p> autorizações necessárias para o uso pretendido. Por exemplo, outros direitos, tais como direitos de imagem, de privacidade ou direitos morais, podem limitar o uso do material.</p>

                <p class="first-p">A íntegra da licença pode ser consultada no link: <a href="http://creativecommons.org/licenses/by/3.0/br/legalcode" title"http://creativecommons.org/licenses/by/3.0/br/legalcode">http://creativecommons.org/licenses/by/3.0/br/legalcode</a></p>
            </section>
        </div>
    </div>
</div>
<!-- termos de uso end -->

<!-- Política de Privacidade start -->
<div class="modal fade" id="modalPrivacy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            <section class="subchapter">
                <h1 class="subchapter-title">Política de privacidade</h1>

                <p class="first-p">A Agência Patrícia Galvão é uma iniciativa do Instituto Patrícia Galvão, criada em 2009 para atuar na produção de notícias e conteúdos sobre os direitos das mulheres brasileiras.</p>

                <p class="first-p">O site da Agência Patrícia Galvão tem caráter gratuito e acesso livre. Todas as informações pessoais de usuários recolhidas serão usadas somente para tornar o seu acesso ao nosso site o mais produtivo e agradável possível e jamais serão utilizadas para fins comerciais.</p>

                <p class="first-p">A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou outros. A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é fundamental para a Agência Patrícia Galvão.</p>

                <p class="first-p">Todas as informações cadastradas no site são mantidas em sigilo nos bancos de dados da Agência Patrícia Galvão.</p>

                <ul>
                    <h4>O usuário, por sua vez, concorda que é proibido por lei:</h4>
                    <li>prejudicar os direitos e interesses de terceiros;</li>
                    <li>inutilizar, modificar ou impedir, em todo ou em parte, qualquer área do site;</li>
                    <li>tentar violar os meios técnicos de proteção ao conteúdo do site.</li>
                </ul>

                <p class="first-p">Tal como outros websites, coletamos e utilizamos informações como seu endereço IP (Internet Protocol), seu ISP (Internet Service Provider), o browser que utilizou ao visitar o nosso site (como o Internet Explorer ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso site.</p>

                <h4>Ligações a sites de terceiros</h4>

                <p class="first-p">A Agência Patrícia Galvão possui ligações para outros sites que podem, a nosso ver, conter informações / ferramentas úteis para os nossos visitantes. Ressaltamos que a nossa política de privacidade não é aplicada a sites de terceiros e que, portando, o usuário que visitar outro site a partir do nosso deverá ler a política de privacidade do mesmo.</p>

                <p class="first-p">Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>

                <p class="first-p">As condições acima relacionadas se encontram amparadas através de normatizações brasileiras.</p>

                <p class="first-p">A partir do momento em que o usuário acessa o nosso site estará automaticamente aderindo e concordando expressamente com as condições aqui dispostas.</p>

                <p class="first-p">A equipe da Agencia Patrícia Galvão reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade a fim de se manter atualizado.</p>
            </section>
        </div>
    </div>
</div>
<!-- Política de Privacidade end -->
