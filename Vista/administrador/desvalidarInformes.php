
<main>
   
    <form action="index.php?action=altaPacientes" method="post">

        <?php
        $medicos = [];
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            $medicos = $model->getInforme() ?? [];
        }
        ?>

        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold mb-6">Informe</h1>

            <div class="bg-white rounded shadow overflow-hidden">
                <div class="overflow-y-auto" style="max-height:500px;">
                    <table class="min-w-full table-fixed border-collapse">
                        <thead>
                            <tr class="bg-blue-600 text-white text-left">
                                <th class="sticky top-0 px-4 py-3 border">id_informe</th>
                                <th class="sticky top-0 px-4 py-3 border">Resultados</th>
                                <th class="sticky top-0 px-4 py-3 border">Validado</th>
                                <th class="sticky top-0 px-4 py-3 border">Fecha Informe</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($medicos)): ?>
                                <?php foreach ($medicos as $medico): ?>
                                    <tr class="even:bg-gray-50 hover:bg-gray-100 border-b">
                                        <td class="px-4 py-3"><?php echo htmlspecialchars($medico[0] ?? ''); ?></td>
                                        <td class="px-4 py-3"><?php echo htmlspecialchars($medico[1] ?? ''); ?></td>
                                        <td class="px-4 py-3"><?php echo htmlspecialchars($medico[2] ?? ''); ?></td>
                                        <td class="px-4 py-3"><?php echo htmlspecialchars($medico[3] ?? ''); ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">No hay médicos registrados
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

</main>
