{extends file='website/base.tpl'}

{block name="main"}
    <section id="contact">
        <h1>{$page->getName()}</h1>
        <hr>

        <div class="contact-info-container">
            <div class="single-box sea-color">
                <div class="belt"></div>
                <div class="position">
                    <span class="text">Biuro <br>projektu</span>
                </div>
                <div class="details">
                    <span class="text">{$page->getValue1()|unescape:'html'}</span>
                </div>
                <div class="clear-fix"></div>
            </div>

            <div class="single-box blue-color">
                <div class="belt"></div>
                <div class="position">
                    <span class="text">Koordynator <br>projektu</span>
                </div>
                <div class="details">
                    <span class="text">{$page->getValue2()|unescape:'html'}</span>
                </div>
                <div class="clear-fix"></div>
            </div>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2399.9414003564248!2d18.566240115826226!3d53.02141637991215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4703344db6c0d037%3A0x12796deb2e92ee47!2sWydzia%C5%82+Nauk+o+Ziemi+UMK!5e0!3m2!1spl!2sus!4v1464269467298" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            <div class="address-container">
                {$page->getContent()}
            </div>
        </div>

    </section>
{/block}