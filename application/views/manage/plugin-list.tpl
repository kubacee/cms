{*{templateId}*}
{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <h3>Wtyczki</h3>

        <ol class="breadcrumb">
            <li class="active">Lista wtyczek</li>
        </ol>
        <hr>

        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 100%">Nazwa</th>
                    <th class="action"></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Zespół</td>
                        <td>
                            <a href="{url path="/manageTeam/showTeams/"}" class="btn btn-default btn-sm">
                                <div class="glyphicon glyphicon-list"></div>
                                Przejdź
                            </a>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Galeria</td>
                        <td>
                            <a href="{url path="/manageGallery/showAlbums/"}" class="btn btn-default btn-sm">
                                <div class="glyphicon glyphicon-list"></div>
                                Przejdź
                            </a>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dokumenty</td>
                        <td>
                            <a href="{url path="/manageDocuments/showSets/"}" class="btn btn-default btn-sm">
                                <div class="glyphicon glyphicon-list"></div>
                                Przejdź
                            </a>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
{/block}