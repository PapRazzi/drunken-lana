<div class="tabs">
    <div class="innerLabel" ><h3>Рейтинг самых активных продавцов</h3></div>
    <div class="table-container yellow index orders">
        <table width="100%">
          <thead class="topics icons">
            <tr>
              <td class="position">{$lang461}</td>
              <td class="name">{$lang462}</td>
              <td class="amount">{$lang463}</td>
            </tr>
          </thead>
          <tbody>
              {section name=i loop=$users}
              <tr class="entry">
                  <td>{$users[i].position|stripslashes}</td>
                  <td>
                      <a style="color:rgb(0, 81, 110)" href="{$baseurl}/{insert name=get_seo_profile value=a username=$users[i].username|stripslashes}/">
                          {$users[i].username|stripslashes}
                      </a>
                  </td>
                  <td>
                     {$users[i].orders_completed|stripslashes}
                  </td>
              </tr>
              {/section}
        </tbody>
      </table>
    </div>
</div>