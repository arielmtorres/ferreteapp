<div id="movimientos-section" class="container py-4">

  <!-- Título principal -->
  <h2 class="mb-4">Egresos e Ingresos</h2>

  <!-- Tabla de Ingresos -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">📥 Ingresos</h3>
      <button class="btn btn-success btn-sm">+ Agregar Ingreso</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-ingresos">
        <thead class="table-light text-center">
          <tr>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Responsable</th>
            <th>Factura</th>
            <th>Observaciones</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr>
            <td>2025-07-12</td>
            <td>Préstamo</td>
            <td>Aporte del socio</td>
            <td>$20,000</td>
            <td>María Gómez</td>
            <td>—</td>
            <td>Fondo para cubrir imprevistos</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>2025-07-11</td>
            <td>Cobro Servicio</td>
            <td>Instalación eléctrica</td>
            <td>$3,500</td>
            <td>Juan Pérez</td>
            <td><button class="btn btn-sm btn-outline-primary btn-sm">Ver Factura</button></td>
            <td>Cliente externo</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>2025-07-10</td>
            <td>Devolución</td>
            <td>Reintegro de proveedor</td>
            <td>$1,200</td>
            <td>Soporte Técnico</td>
            <td>—</td>
            <td>Producto dañado devuelto</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Tabla de Egresos -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">📤 Egresos</h3>
      <button class="btn btn-success btn-sm">+ Agregar Egreso</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-egresos">
        <thead class="table-light text-center">
          <tr>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Responsable</th>
            <th>Factura</th>
            <th>Observaciones</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr>
            <td>2025-07-12</td>
            <td>Sueldos</td>
            <td>Pago mensual Julio</td>
            <td>$15,000</td>
            <td>RRHH</td>
            <td>—</td>
            <td>Planilla firmada por empleados</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>2025-07-11</td>
            <td>Mantenimiento</td>
            <td>Reparación de aire acondicionado</td>
            <td>$2,300</td>
            <td>Carlos Díaz</td>
            <td><button class="btn btn-sm btn-outline-primary">Ver Factura</button></td>
            <td>Servicio técnico contratado</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>2025-07-10</td>
            <td>Viáticos</td>
            <td>Viaje a proveedor</td>
            <td>$850</td>
            <td>Lucía Romero</td>
            <td>—</td>
            <td>Combustible y peajes</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Tabla de Categorías -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">🏷️ Categorías de Ingresos/Egresos</h3>
      <button class="btn btn-success btn-sm">+ Agregar Categoría</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="tabla-categorias">
        <thead class="table-light text-center">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr>
            <td>CAT-001</td>
            <td>Venta</td>
            <td>Ingreso</td>
            <td>Ingresos por ventas de productos</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-002</td>
            <td>Compra</td>
            <td>Egreso</td>
            <td>Compra de mercadería e insumos</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-003</td>
            <td>Préstamo</td>
            <td>Ingreso</td>
            <td>Aportes temporales de socios o terceros</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-004</td>
            <td>Sueldos</td>
            <td>Egreso</td>
            <td>Pago de salarios al personal</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-005</td>
            <td>Mantenimiento</td>
            <td>Egreso</td>
            <td>Servicios de reparación o conservación</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-006</td>
            <td>Viáticos</td>
            <td>Egreso</td>
            <td>Gastos de viaje relacionados al negocio</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
          <tr>
            <td>CAT-007</td>
            <td>Cobro Servicio</td>
            <td>Ingreso</td>
            <td>Ingresos por servicios técnicos o externos</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>
