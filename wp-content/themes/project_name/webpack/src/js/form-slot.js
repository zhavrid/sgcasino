jQuery(function($){
    $(document).on('click', '.slots__list__item-delete', function(e){
        e.preventDefault();

        if (!confirm('delete this slot?')) return;

        var $btn = $(this);
        var slotId = $btn.data('id');

        if (!slotId) {
            console.warn('slot id not found');
            return;
        }

        $.ajax({
            url: sgcasino_ajax.ajax_url,
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_slot',
                slot_id: slotId,
                nonce: sgcasino_ajax.nonce
            },
            success: function(response){
                if (response.success) {
                    $btn.closest('.slots__list__item').fadeOut(200, function(){ $(this).remove(); });
                } else {
                    alert('Error: ' + (response.data || 'Unknown error'));
                }
            },
            error: function(xhr, status, error){
                console.error('AJAX error', xhr.responseText);
            }
        });
    });
});
