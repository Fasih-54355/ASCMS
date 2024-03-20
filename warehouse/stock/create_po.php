<script>
    var items = <?php echo json_encode($item_arr); ?>;
    var costs = <?php echo json_encode($cost_arr); ?>;

    $(function () {
        $('.select2').select2({
            placeholder: "Please select here",
            width: 'resolve',
        });

        $('#item_id').select2({
            placeholder: "Please select supplier first",
            width: 'resolve',
        });

        $('#supplier_id').change(function () {
            var supplier_id = $(this).val();
            $('#item_id').select2('destroy');

            if (items.hasOwnProperty(supplier_id)) {
                $('#item_id').html('');
                $.each(items[supplier_id], function (id, row) {
                    var opt = $('<option>').attr('value', id).text(row.name);
                    $('#item_id').append(opt);
                });

                $('#item_id').select2({
                    placeholder: "Please select item here",
                    width: 'resolve',
                });
            } else {
                $('#item_id').select2({
                    placeholder: "No Items Listed yet",
                    width: 'resolve',
                });
            }
        });

        $('#add_to_list').click(function () {
            var supplier = $('#supplier_id').val();
            var item = $('#item_id').val();
            var qty = $('#qty').val() > 0 ? $('#qty').val() : 0;
            var unit = $('#unit').val();
            var price = costs[item] || 0;
            var total = parseFloat(qty) * parseFloat(price);

            var item_name = items[supplier][item].name || 'N/A';
            var item_description = items[supplier][item].description || 'N/A';

            var tr = $('#clone_list tr').clone();

            if (item == '' || qty == '' || unit == '') {
                alert_toast('Form Item textfields are required.', 'warning');
                return false;
            }

            if ($('table#list tbody').find('tr[data-id="' + item + '"]').length > 0) {
                alert_toast('Item is already exists on the list.', 'error');
                return false;
            }

            tr.find('[name="item_id[]"]').val(item);
            tr.find('[name="unit[]"]').val(unit);
            tr.find('[name="qty[]"]').val(qty);
            tr.find('[name="price[]"]').val(price);
            tr.find('[name="total[]"]').val(total);
            tr.attr('data-id', item);
            tr.find('.qty .visible').text(qty);
            tr.find('.unit').text(unit);
            tr.find('.item').html(item_name + '<br/>' + item_description);
            tr.find('.cost').text(parseFloat(price).toLocaleString('en-US'));
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'));
            $('table#list tbody').append(tr);
            calc();
            $('#item_id').val('').trigger('change');
            $('#qty').val('');
            $('#unit').val('');
            tr.find('.rem_row').click(function () {
                rem($(this));
            });

            $('[name="discount_perc"],[name="tax_perc"]').on('input', function () {
                calc();
            });

            $('#supplier_id').attr('readonly', 'readonly');
        });

        $('#po-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_po",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function (err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.replace(_base_url_ + "admin/?page=purchase_order/view_po&id=" + resp.id);
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>').addClass("alert alert-danger err-msg").text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        end_loader();
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                        console.log(resp);
                    }
                    $('html,body').animate({ scrollTop: 0 }, 'fast');
                }
            });
        });

        if ('<?php echo isset($id) && $id > 0 ?>' == 1) {
            calc();
            $('#supplier_id').trigger('change');
            $('#supplier_id').attr('readonly', 'readonly');
            $('table#list tbody tr .rem_row').click(function () {
                rem($(this));
            });
        }
    });

    function rem(_this) {
        _this.closest('tr').remove();
        calc();
        if ($('table#list tbody tr').length <= 0)
            $('#supplier_id').removeAttr('readonly');
    }

    function calc() {
        var sub_total = 0;
        var grand_total = 0;
        var discount = 0;
        var tax = 0;

        $('table#list tbody input[name="total[]"]').each(function () {
            sub_total += parseFloat($(this).val());
        });

        $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US', { style: 'decimal', maximumFractionDigit: 2 }));
        discount = sub_total * (parseFloat($('[name="discount_perc"]').val()) / 100);
        sub_total = sub_total - discount;
        tax = sub_total * (parseFloat($('[name="tax_perc"]').val()) / 100);
        grand_total = sub_total + tax;

        $('.discount').text(parseFloat(discount).toLocaleString('en-US', { style: 'decimal', maximumFractionDigit: 2 }));
        $('[name="discount"]').val(parseFloat(discount));
        $('.tax').text(parseFloat(tax).toLocaleString('en-US', { style: 'decimal', maximumFractionDigit: 2 }));
        $('[name="tax"]').val(parseFloat(tax));
        $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US', { style: 'decimal', maximumFractionDigit: 2 }));
        $('[name="amount"]').val(parseFloat(grand_total));
    }
</script>
