<section class="page-step s1-about" data-step="1">

    <div class="step-header">
        <div class="container">
            <div class="lettering">
              <h1 class="step-title">Fale um pouco sobre você</h1>
            </div>
        </div>

         <div class="header-img">
            <img src="images/header-img-2.jpg" alt="">
        </div>

    </div>

    <div class="step-content">
        <div class="container">
            <div class="person-form-group" data-id="user">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="user_color">Clique para escolher uma cor de identificação</label>
                        <div class="color-picker" data-input="user_color"></div>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label for="user_name"><span class="i-user3"></span>Qual o seu nome?</label>
                                <input class="form-control" type="text" name="user_name" pattern="\w+" required>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="user_age"><span class="i-cake"></span>Quantos anos você tem?</label>
                                <input class="form-control" type="text" name="user_age" pattern="\d+" required>
                            </div>
                        </div>

                        <div class="form-group radio-input">
                            <label for="user_gender">Qual o seu gênero?</label>
                            <span class="radio-button-enforcer" data-name="user_gender"><input type="radio" name="user_gender" value="NULL" checked></span>
                            <label class="radio-label"><input type="radio" name="user_gender" value="M"><span class="i-male"></span>Masculino</label>
                            <label class="radio-label"><input type="radio" name="user_gender" value="F"><span class="i-female"></span>Feminino</label>
                            <label class="radio-label"><input type="radio" name="user_gender" value="O"><span class="i-transgender"></span>Outro</label>
                        </div>

                        <div class="form-group radio-input">
                            <label for="user_race"><span class="i-smiley2"></span>Qual é sua raça/cor?</label>
                            <span class="radio-button-enforcer" data-name="user_race"><input type="radio" name="user_race" value="NULL" checked></span>
                            <label class="radio-label"><input type="radio" name="user_race" value="branca">Branca</label>
                            <label class="radio-label"><input type="radio" name="user_race" value="preta">Preta</label>
                            <label class="radio-label"><input type="radio" name="user_race" value="parda">Parda</label>
                            <label class="radio-label"><input type="radio" name="user_race" value="amarela">Amarela</label>
                            <label class="radio-label"><input type="radio" name="user_race" value="indigena">Indígena</label>
                            <label class="radio-label"><input type="radio" name="user_race" value="nao">Não quero responder</label>
                        </div>

                         <div class="form-group radio-input">
                            <label for="house_people"><span class="i-home3"></span>Você mora sozinho(a)?</label>
                            <span class="radio-button-enforcer" data-name="house_people"><input type="radio" name="house_people" value="NULL" checked></span>
                            <label class="radio-label"><input type="radio" name="house_people" value="Y">Sim</label>
                            <label class="radio-label"><input type="radio" name="house_people" value="N">Não</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- nav buttons start -->
    <nav class="nav-buttons">
        <div class="container">
            <button type="stepper" class="btn-press btn-back" data-step="0">
                <span class="i-arrow-left2"></span>
                <span class="button-text">Anterior</span>
            </button>
            <button type="stepper" class="btn-press btn-next" data-step="2">
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
