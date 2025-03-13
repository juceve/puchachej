<script>
    $(document).ready(function() {

        $('.select2').select2({
            theme: 'bootstrap4',
        });


    });

    Livewire.on('success', msg => {
        Swal.fire({
            title: "Excelente!",
            text: msg,
            icon: "success"
        });
    })
    Livewire.on('error', msg => {
        Swal.fire({
            title: "Error",
            text: msg,
            icon: "error"
        });
    })
    Livewire.on('warning', msg => {
        Swal.fire({
            title: "Atención!",
            text: msg,
            icon: "warning"
        });
    })

Livewire.on('imprimir',data=>{
    window.open("/impresiones/reciboaporte.php?data=" + data, "_blank");
})
</script>
@if (session('warning'))
<script>
    Swal.fire(
        'Atención!',
        '{{ session('warning') }}',
        'warning'
    )
</script>
@endif

@if (session('error'))
<script>
    Swal.fire(
                'Error',
                '{{ session('error') }}',
                'error'
            )
</script>
@endif
@if (session('success'))
<script>
    Swal.fire(
                'Excelente!',
                '{{ session('success') }}',
                'success'
            )
</script>
@endif