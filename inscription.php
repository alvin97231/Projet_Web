<?php
  $AppelInclude = './include/';
  require($AppelInclude . "header.inc.html");
?>
  <section>
    <div  id = "corps_page">
      <form  action="" autocomplete="on">
        <table>
          <td>
              <fieldset>
                <legend>Informations Personnelle</legend>
                <table>
                  <tr>
                    <td><label for="nom">Nom : </label></td>
                    <td><input name="uname" class="regForm" type="text"/></td>
                  </tr>
                  <tr>
                    <td><label for="nom">Prenom : </label></td>
                    <td><input name="uname" class="regForm" type="text"/></td>
                  </tr>
                  <tr>
                    <td><label for="mail">Email : </label></td>
                    <td><input name="mail" class="regForm" type="text"/></td>
                  </tr>
                </table>
              </fieldset>
          </td>
          <td>
            <fieldset>
              <legend>Informations Compte</legend>
                <table>
                <tr>
                  <td><label for="type">Vous êtes : </label></td>
                  <td><input name="type" type="radio" value="true"/>Professeur
                  <input name="type" type="radio" value="false"/>Elève</td>
                </tr>
                <tr>
                  <td><label for="password">Mot de passe : </label></td>
                  <td><input name="password" class="regForm" type="password"/></td>
                </tr>
                <tr>
                  <td><label for="password">Confirmer mot de passe : </label></td>
                  <td><input name="password" class="regForm" type="password"/></td>
                </tr>
              </table>
              </fieldset>
            </td>
          </table>
        </form>
      <input value="Sign in" id="login" type="submit"/>
    </fieldset>

    </div>
  </section>
<?php
  require($AppelInclude . "footer.inc.html");
?>
