{*{templateId}*}
{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <h3>Ustawienia</h3>

        <ol class="breadcrumb">
            <li class="active">Lista ustawień</li>
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
                        <td>Użytkownik</td>
                        <td>
                            <a href="{url path="/manageSettings/editUser/"}" class="btn btn-primary btn-sm">
                                <div class="glyphicon glyphicon-pencil"></div>
                                Edytuj
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
{/block}