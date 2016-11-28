{extends file='website/base.tpl'}

{block name="main"}
    <h1>{$page->getName()}</h1>
    <hr>
    <article id="sub-page-content">
        {$count = 0}
        {foreach $teamList as $person}
            {$classColor = 'color-green'}

            {if $count == 0}
                {$classColor = 'color-green'}
            {/if}

            {if $count == 1}
                {$classColor = 'color-sea'}
            {/if}

            {if $count == 2}
                {$classColor = 'color-blue'}
            {/if}

            {if $count == 3}
                {$classColor = 'color-pink'}
            {/if}

            {if $count == 4}
                {$classColor = 'color-red'}
            {/if}

            {if $count == 5}
                {$classColor = 'color-orange'}
                {$count = -1}
            {/if}


            <div class="single-person {$classColor}">
                <div class="belt"></div>
                <div class="position">
                    <div class="wrapper">
                        <div class="text">
                            {$person->getName()}
                        </div>
                    </div>
                </div>
                <div class="details">
                    <div class="person-name">
                        <div class=text>
                            {$person->getValue1()}
                        </div>
                    </div>
                    <div class="person-contact">
                        <div class="wrapper">
                            <div class="group">
                                <div class="contact phone">{$person->getValue4()}</div>
                                <div class="contact email">{$person->getValue3()}</div>
                            </div>
                            <div class="group">
                                <div class="contact room">pokój {$person->getValue2()}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
            </div>
            {$count = $count + 1}
        {/foreach}
    </article>
{/block}