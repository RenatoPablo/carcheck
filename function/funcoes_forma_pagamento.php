<?php 

function cadastrarForma($pdo, $forma) {
    $sql = "SELECT * FROM formas_pagamento WHERE tipo_pagamento = :forma";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':forma' => $forma]);

    if($stmt->rowCount() > 0) {
        $forma_pagamento = $stmt->fetch(PDO::FETCH_ASSOC);
        return $forma_pagamento['id_forma_pagamento'];
    }
    $sqlInsert = "INSERT INTO formas_pagamento (tipo_pagamento) VALUES (:forma)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':forma' => $forma]);
    
    return $pdo->lastInsertId();
}

?>