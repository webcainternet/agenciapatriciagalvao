<script id="person-input-template" type="text/x-handlebars-template">
    <div class="person-form-group" data-id="{{ id }}">
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="people_color[]">Cor para identificação nesta pesquisa:</label>
                <div class="color-picker" data-input="people_color[]"></div>
            </div>

            <div class="col-sm-9">
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="people_name[]"><span class="i-user3"></span>Nome</label>
                        <input class="form-control" type="text" name="people_name[]" pattern="\w+" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="people_age[]"><span class="i-cake"></span>Idade</label>
                        <input class="form-control" type="text" name="people_age[]" pattern="\d+" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="people_gender[{{ index }}]">Gênero</label>
                    <span class="radio-button-enforcer" data-name="people_gender[{{ index }}]"><input type="radio" name="people_gender[{{ index }}]" value="NULL" checked></span>
                    <label class="radio-label"><input type="radio" name="people_gender[{{ index }}]" value="M"><span class="i-male"></span>Masculino</label>
                    <label class="radio-label"><input type="radio" name="people_gender[{{ index }}]" value="F"><span class="i-female"></span>Feminino</label>
                    <label class="radio-label"><input type="radio" name="people_gender[{{ index }}]" value="O"><span class="i-transgender"></span>Outro</label>
                </div>

                <div class="form-group radio-input">
                    <label for="people_race[{{ index }}]"><span class="i-smiley2"></span>Raça/cor?</label>
                    <span class="radio-button-enforcer" data-name="people_race[{{ index }}]"><input type="radio" name="people_race[{{ index }}]" value="NULL" checked></span>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="branca">Branca</label>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="preta">Preta</label>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="parda">Parda</label>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="amarela">Amarela</label>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="indigena">Indígena</label>
                    <label class="radio-label"><input type="radio" name="people_race[{{ index }}]" value="nao">Não quero responder</label>
                </div>
            </div>

            <button type="remover" class="btn-press btn-remove" data-type="person">
                <span class="i-minus">-</span>
                <span class="button-text">Remover</span>
            </button>
            <hr>
        </div>
    </div>
</script>

<script id="person-slider-template" type="text/x-handlebars-template">
    <div class="person-slider" data-id="{{ id }}">
        <hr>
        <span class="slider-image person-color profile-color-box clock-icon clock-time-0"></span>
        <span class="person-name"></span>
        <h4 class="js-working-hours-indicator">0</h4>
        <div class="jui-person-slider" data-input="people_slider[]"></div>
        <input type="hidden" name="people_slider[]">
    </div>
</script>

<script id="person-drawer-template" type="text/x-handlebars-template">
    <a class="user-area" href="#" title="" data-id="{{ id }}">
        <div class="person-info">
            <span class="i-smiley2 person-color"></span>
            <span class="person-name">{{ name }}</span>
        </div>
        <div class="user-icon-drawer clearfix"></div>
    </a>
</script>

<script id="alert-bubble-template" type="text/x-handlebars-template">
    <div id="bubble-alert" class="alert">
        <div class="container">
            <div class="alert-bubble alert-{{ type }}">
                <p>{{ message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        </div>
    </div>
</script>

<script id="result-template" type="text/x-handlebars-template">
    <div class="result-unit clearfix result-unit-{{ id }}">
        <span class="result-person">{{ name }}</span>
        <div class="result-bars clearfix">
            <div class="result-bar result-bar-children"></div>
            <div class="result-bar result-bar-household"></div>
            <div class="result-bar result-bar-outbound"></div>
        </div>
    </div>
</script>

<script id="result-share-template" type="text/x-handlebars-template">
    <a href="https://www.facebook.com/dialog/feed?display=popup&app_id=<?php echo $fb_id; ?>&link={{ url }}&picture={{ picture }}&name={{ title }}&description={{ description }}&redirect_uri={{ url }}" class="i-facebook2" title="Compartilhe no Facebook" data-sharer></a>
    <a href="https://twitter.com/share?url={{ url }}&text={{ twitterTitle }}" class="i-twitter2" title="Compartilhe no Twitter" data-sharer></a>
    <a href="https://plus.google.com/share?url={{ url }}" class="i-google-plus3" title="Compartilhe no Google Plus" data-sharer></a>
    <a href="mailto:?body={{ emailBody }}&subject={{ emailSubject }}" class="i-mail2" title="Compartilhe por e-mail" data-sharer></a>
</script>
