jQuery(function($){
    // делегирование — работает для динамически добавленных элементов
    $(document).on('click', '.delete-slot', function(e){
        e.preventDefault();

        if (!confirm('Удалить этот слот?')) return;

        var $btn = $(this);
        var slotId = $btn.data('id');

        if (!slotId) {
            console.warn('slot id not found');
            return;
        }

        $.ajax({
            url: sgcasino_ajax.ajax_url,       // из wp_localize_script
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_slot',
                slot_id: slotId,
                nonce: sgcasino_ajax.nonce
            },
            success: function(response){
                if (response.success) {
                    // аккуратно убрать элемент из DOM
                    $btn.closest('.slot-item').fadeOut(200, function(){ $(this).remove(); });
                } else {
                    alert('Ошибка: ' + (response.data || 'Неизвестная ошибка'));
                }
            },
            error: function(xhr, status, error){
                // покажем подробную ошибку в консоль и уведомим пользователя
                console.error('AJAX error', xhr.responseText);
                alert('Сетевая ошибка, см. консоль (F12)');
            }
        });
    });
});
