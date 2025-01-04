<?php


function exibirMensagem($mensagem, $cor){
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            M.toast({html: " . json_encode($mensagem) . ", classes: '$cor'});
        });
    </script>";
}


?>