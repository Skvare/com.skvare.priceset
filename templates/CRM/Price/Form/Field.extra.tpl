{if $form.pricefield_allow_other_amount_range}
{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('#minMaxFields').insertAfter('.crm-price-field-form-block-non-deductible-amount');
      $('.crm-price-field-form-block_pricefield_allow_other_amount_range').insertAfter('.crm-price-field-form-block-non-deductible-amount');
      
      var element_other_amount = document.getElementsByName('pricefield_allow_other_amount_range');
      if (! element_other_amount[0].checked) {
        $('#minMaxFields').hide();
      }
    });
    function minMax(chkbox) {
      if (chkbox.checked) {
        cj('#minMaxFields').show();
      } else {
        cj('#minMaxFields').hide();
        document.getElementById("pricefield_min_range").value = '';
        document.getElementById("pricefield_max_range").value = '';
      }
    }
  </script>
{/literal}

  <table class="form-layout-compressed" style="display: none">
    <tr class="crm-price-field-form-block_pricefield_allow_other_amount_range">
      <td class="label">{$form.pricefield_allow_other_amount_range.label}</td>
      <td>{$form.pricefield_allow_other_amount_range.html}</td>
    </tr>
    <tr id="minMaxFields" class="crm-contribution-form-block-minMaxFields"><td>&nbsp;</td><td>
      <table class="form-layout-compressed">
        <tr class="crm-price-field-form-block_pricefield_min_range">
          <td class="label">{$form.pricefield_min_range.label}</td>
          <td>{$form.pricefield_min_range.html}</td>
        </tr>
        <tr class="crm-price-field-form-block_pricefield_max_range">
          <td class="label">{$form.pricefield_max_range.label}</td>
          <td>{$form.pricefield_max_range.html}<br />
            <span class="description">{ts 1=5|crmMoney}If you have chosen to <strong>Set Amount range</strong>, you can use the fields above to control minimum and/or maximum acceptable values (e.g. don't allow contribution amounts less than %1).{/ts}</span></td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
{/if}
