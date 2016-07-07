<section class="page-step s3-house" data-step="3">

    <div class="step-header">
        <div class="container">
            <div class="lettering">
                <h1 class="step-title">Fale mais sobre a sua casa</h1>
                <p class="step-subtitle">Quanto maior o tamanho da casa, mais trabalho: mais espaço para limpar e varrer, mais banheiros para lavar, enfim, mais trabalho doméstico.</p>
            </div>
        </div>

         <div class="header-img">
            <img src="images/header-img-4.jpg" alt="">
        </div>

    </div>

    <div class="step-content">
        <div class="container">
            <div class="slider-image-area">
                <h2 class="info-text">Qual o tamanho da sua casa (em m<sup>2</sup>)</h2>
                <span class="house-illustration house-size-0"></span>
                <h4 class="js-house-size-indicator">0</h4>

                <div id="house-slider"></div>
                <input type="hidden" name="house_slider">
            </div>

            <div class="slider-maid-area">
                <h2 class="info-text">Além de você(s), há alguma empregada doméstica trabalhando na sua casa? Se sim, quantas vezes por semana?</h2>
                <span class="maid-illustration"></span>
                <h4 class="js-maid-time-indicator">0</h4>

                <div id="maid-slider"></div>
                <input type="hidden" name="maid_slider">

                <div class="maid-add-info">
                    <h2 class="info-text">Passe alguns dados sobre o profissional que trabalha em sua casa:</h2>

                    <div class="form-group">
                        <label for="maid_age">Idade:</label>
                        <input class="form-control" type="text" name="maid_age" pattern="\d+">
                    </div>

                    <div class="form-group radio-input">
                        <label for="maid_gender">Gênero?</label>
                        <label class="radio-label"><input type="radio" name="maid_gender" value="M"><span class="i-male"></span>Masculino</label>
                        <label class="radio-label"><input type="radio" name="maid_gender" value="F"><span class="i-female"></span>Feminino</label>
                        <label class="radio-label"><input type="radio" name="maid_gender" value="O"><span class="i-transgender"></span>Outro</label>
                    </div>

                    <div class="form-group radio-input">
                        <label for="maid_race">Raça/cor?</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="branca">Branca</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="preta">Preta</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="parda">Parda</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="amarela">Amarela</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="indigena">Indígena</label>
                        <label class="radio-label"><input type="radio" name="maid_race" value="nao">Não quero responder</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- nav buttons start -->
    <nav class="nav-buttons">
        <div class="container">
            <button type="stepper" class="btn-press btn-back" data-step="2">
                <span class="i-arrow-left2"></span>
                <span class="button-text">Anterior</span>
            </button>
            <button type="stepper" class="btn-press btn-next" data-step="4">
                <span class="button-text">Próximo</span>
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
