<div class="error-message flex">
    <div class="round flex column">
        <h1>
            <?PHP
                foreach ($messages as $msg) {
                    echo $msg;
                }
            ?>
        </h1>
        <i class="far fa-times-circle"></i>
    </div>
</div>
<script>
    document.querySelector(".fa-times-circle").addEventListener("click", () => {
        document.querySelector(".error-message").style.display = "none";
    })

</script>