<style>

    .support-category-table td{
        padding: 0;
    }

    .support-category-table-o {

    }
    .support-category-table-vertical .support-category-left-top {
        border-right: 1px solid black;
    }
    .support-category-table-vertical .support-category-left-bottom {
        border-right: 1px solid black;
    }
    .support-category-table-cross .support-category-left-top {
        border-right: 1px solid black;
    }
    .support-category-table-cross .support-category-right-top {
        border-bottom: 1px solid black;
    }
    .support-category-table-cross .support-category-left-bottom {
        border-right: 1px solid black;
    }

    .support-category-table-l .support-category-right-top {
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }
    .support-category-table-l .support-category-left-top {
        border-right: 1px solid black;
    }

    .support-category-table-horizont .support-category-left-top {
        border-bottom: 1px solid black;
    }
    .support-category-table-horizont .support-category-right-top {
        border-bottom: 1px solid black;
    }

    .support-category-table-t .support-category-left-top {
        border-bottom: 1px solid black;
    }
    .support-category-table-t .support-category-right-top {
        border-bottom: 1px solid black;
    }
    .support-category-table-t .support-category-left-bottom {
        border-right: 1px solid black;
    }


</style>

<table style="width: 25px;height: 25px;" class="support-category-table support-category-table-{{ $symbol }}">
    <tr>
        <td class="support-category-left-top"></td>
        <td class="support-category-right-top"></td>
    </tr>
    <tr>
        <td class="support-category-left-bottom"></td>
        <td class="support-category-right-bottom"></td>
    </tr>
</table>
