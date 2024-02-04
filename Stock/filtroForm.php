<form action="stock.php" method="GET" id="filtroForm">
    <table>
        <tr>
            <th>Formato:</th>
            <th>Color:</th>
            <th>Gramaje:</th>
            <th>Listado precio Fecha:</th>
            <th>Listado precio Cantidades:</th>
        </tr>
        <tr>
            <td>
                <select name="Formato" onchange="submitForm()">
                    <option value="todos" <?php echo $formatoFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    
                    <option value="12 X 08 X 19" <?php echo $formatoFilter === '12 X 08 X 19' ? 'selected' : ''; ?>>12 X 08 X 19</option>
                    <option value="12 X 08 X 26" <?php if ($formatoFilter === '12 X 08 X 26') echo 'selected'; ?>>12 x 08 x 26</option> 
                    <option value="12 X 08 X 40" <?php if ($formatoFilter === '12 X 08 X 40') echo 'selected'; ?>>12 x 08 x 40</option>

                    <option value="22 X 10 X 20" <?php echo $formatoFilter === '22 X 10 X 20' ? 'selected' : ''; ?>>22 X 10 X 20</option>
                    <option value="22 X 10 X 24" <?php if ($formatoFilter === '22 X 10 X 24') echo 'selected'; ?>>22 x 10 x 24</option>
                    <option value="22 X 10 X 30" <?php if ($formatoFilter === '22 X 10 X 30') echo 'selected'; ?>>22 x 10 x 30</option>
                    <option value="22 X 10 X 42" <?php if ($formatoFilter === '22 X 10 X 42') echo 'selected'; ?>>22 x 10 x 42</option>

                    <option value="26 X 12 X 36" <?php if ($formatoFilter === '26 X 12 X 36') echo 'selected'; ?>>26 x 12 x 36</option>
                    <option value="26 X 12 X 41" <?php if ($formatoFilter === '26 X 12 X 41') echo 'selected'; ?>>26 x 12 x 41</option>

                    <option value="28 X 12 X 41" <?php if ($formatoFilter === '28 X 12 X 41') echo 'selected'; ?>>28 x 12 x 41</option>
                    <option value="28 X 16 X 38" <?php if ($formatoFilter === '28 X 16 X 38') echo 'selected'; ?>>28 x 16 x 38</option>

                    <option value="30 X 12 X 32" <?php if ($formatoFilter === '30 X 12 X 32') echo 'selected'; ?>>30 x 12 x 32</option>
                    <option value="30 X 12 X 41" <?php if ($formatoFilter === '30 X 12 X 41') echo 'selected'; ?>>30 x 12 x 41</option>
                    <option value="30 X 16 X 43" <?php if ($formatoFilter === '30 X 16 X 43') echo 'selected'; ?>>30 x 16 x 43</option>
                </select>
            </td>
            <td>
                <select name="color" onchange="submitForm()">
                    <option value="todos" <?php echo $colorFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    <option value="Marrón" <?php echo $colorFilter === 'Marrón' ? 'selected' : ''; ?>>Marrón</option>
                    <option value="Blanco" <?php echo $colorFilter === 'Blanco' ? 'selected' : ''; ?>>Blanco</option>
                </select>
            </td>
            <td>
                <select name="gramaje" onchange="submitForm()">
                    <option value="todos" <?php echo $gramajeFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    <option value="80" <?php echo $gramajeFilter === '80' ? 'selected' : ''; ?>>80</option>
                    <option value="100" <?php echo $gramajeFilter === '100' ? 'selected' : ''; ?>>100</option>
                </select>
            </td>
            <td>
            <select name="fechaSeleccionada">
                <?php foreach ($fechas as $fecha) {
                    echo '<option value="'.$fecha['fecha'].'">'.$fecha['fecha'].'</option>';} ?>
            </select>
            </td>      
            <td>
                <select name="cantidades" onchange="submitForm()">
                    <option value="5000" >5000</option>
                    <option value="10000" >10000</option>
                </select>
            </td>      
        </tr>
    </table>
    <br>
    <input type="submit" value="Filtrar" style="display: none;">
</form>