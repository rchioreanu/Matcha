<link href="https://ir.ebaystatic.com/rs/v/l1mbw3dzcm2cpjrcyjvpbyxjfe1.css" type="text/css" rel="stylesheet">
<link href = "style.css" rel = "stylesheet">
<?php
include 'header.php';
include 'includes.php';
?>
<div class="sbx-c container center" id="mainContent" role="main" tabindex="-1">
        <h2 class="sbx-h rct-hm rct-bg">Find people</h2>
<div class="sbx-b rct-c rct-bb">
    <div class="cont">
        <form id="adv_search_from" name="adv_search_from" action="find.php" method="get">

            <fieldset>
                <legend id="kw_lengend">Find your love right now!<br />Seriously.</legend>
                <label for="ex_kwlabel" class="inline-block space-top control-label">
                   Interest: </label><br /><input class="form-control block center" style = "width: 15%; display: block; margin: 0 auto" name = "interest" type = "text">
                </label>
                <div class="space-top"></div>
                <label for="e1-1" class="inline-block space-top">
                    Gender:<select class="block" name="gender" id="e1-1">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="fluid">Gender fluid</option>
                            <option value="person">Doesn't matter</option>
                            </select>
                </label><br><br>

                </fieldset>

            <fieldset>
                <legend>Age</legend>
                <input aria-label="Include an age range value for search results" title="Include an age range value for search results" type="checkbox" id="_mPrRngCbx" name="age" value="18">
                <label for="_mPrRngCbx">Show people aged from</label><input class="price" type="text" name="minage" placehoder="All Ages" value="" title="Enter minimum age range value" aria-label="Enter minimum age range value"> to <input class="price" type="text" name="maxage" maxlength="13" value="" title="Enter maximum price range value" aria-label="Enter maximum price range value"></fieldset>
            <fieldset class="checkbox-set">
                <legend>Show results</legend>

                <div class="fields">
                    <input aria-label="Include popularity for search results" title="Include popularity for search results" type="checkbox" id="LH_Time" name="sort" value="1">
                    <label for="LH_Time">Sort by</label><select name="sort_type"><option value="asc">The youngest</option><option value="desc">The oldest</option></select></div>
                <label for="LH_SaleItems">
                    <input type="checkbox" id="LH_SaleItems" name="lonely" value="1">
                    Lonely as you</label><br>

                </fieldset><fieldset class="checkbox-set location-set">
    <legend>Location</legend>
    <table cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
                        <td class="loc_option_select">
                            <select name="radius" id="_sadis"><option value="2">2</option><option value="5">5</option><option value="10">10</option><option value="15" selected="selected">15</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option><option value="150">150</option><option value="200">200</option><option value="500">500</option><option value="750">750</option><option value="1000">1000</option><option value="1500">1500</option><option value="2000">2000</option></select> KM away from me
                        </td>
                    </tr>
                </tbody></table>
        </fieldset>
            <hr size="1" noshade="noshade" class="seperator">
            <div class="bottom-action-bar">
                <span class="adv-s mb"><input type="submit" class="btn btn-prim" id="searchBtnLowerLnk" value = "Search" /></span>
            </div>

        </form>
    </div>
</div>
</div>
