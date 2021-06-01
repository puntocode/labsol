<div class="row tab-content" id="cards-info">

  <div class="col-lg-6 col-xl-4 tab-pane " id="card-1" role="tabpanel" aria-labelledby="card-1">
    <div class="card card-custom card-stretch gutter-b py-5">
      <div class="card-header border-0">
        <div class="card-title">
          <h3 class="card-label">Equipos Activos</h3>
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="description-chart mb-5 mx-n2">
          <!--begin: Datatable-->
          <table id="table_EquiposActivos" class="display table-chart" style="width:100%">
            <thead>
              <tr>
                <th class="text-primary">Equipos</th>
                <th class="text-primary">Unidades</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tomógrafos</td>
                <td class="text-right">38</td>
              </tr>
              <tr>
                <td>Angiógrafos</td>
                <td class="text-right">37</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th class="border-top pt-3">Total general</th>
                <th class="border-top pt-3 text-right">75</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!--end::Datatable-->

        <!--begin::Chart-->
        <div id="chartEquiposActivos" class="d-flex justify-content-center"></div>
        <!--end::Chart-->
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xl-4 tab-pane " id="card-2" role="tabpanel" aria-labelledby="card-2">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0">
        <h3 class="card-title font-weight-bolder text-dark">Contratos a Vencer</h3>
        <div class="card-toolbar">
          <div class="dropdown dropdown-inline">
            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ki ki-bold-more-ver"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
              <!--begin::Navigation-->
              <ul class="navi navi-hover">

                <li class="navi-item">
                  <a href="{{route('panel.clientes.contratos.index')}}" class="navi-link">
                    <span class="navi-text">
                      Ver todos
                    </span>
                  </a>
                </li>

              </ul>
              <!--end::Navigation-->
            </div>
          </div>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Centro Médico La Costa</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2">05/03/2021 - Presentación de Oferta</span>
            </span>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2">11/03/2021 - Insistencia realizada al Cliente</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="text-muted font-weight-bolder font-size-sm">Vigente hasta</span>
              <span class="text-dark-75 font-weight-bolder font-size-h4">01/05/2021</span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Sanatorio Migone Battilana S.A</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2">11/03/2021 - Insistencia realizada al Cliente</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="text-muted font-weight-bolder font-size-sm">Vigente hasta</span>
              <span class="text-dark-75 font-weight-bolder font-size-h4">01/05/2021</span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>

  <div class="col-lg-6 col-xl-4 tab-pane " id="card-3" role="tabpanel" aria-labelledby="card-3">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0">
        <h3 class="card-title font-weight-bolder text-dark">Mantenimientos correctivos</h3>

      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ACUSON SC 2000</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-danger">
                Prioridad Alta
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ACUSON SC 2000</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-warning">
                Prioridad Media
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>

  <div class="col-lg-4 col-xl-5 tab-pane " id="card-4" role="tabpanel" aria-labelledby="card-4">
    <div class="card card-custom gutter-b card-stretch">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <div class="card-title font-weight-bolder">
          <div class="card-label">Cumplimiento Mensual
            <div class="font-size-sm text-muted mt-2">20 Mantenimientos Preventivos</div>
          </div>
        </div>

      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body" style="position: relative;">
        <!--begin::Chart-->
        <div id="progresoMP" style="height: 250px"></div>
        <!--end::Chart-->
        <!--begin::Items-->
        <div class="mt-n12 position-relative zindex-0">
          <!--begin::Widget Item-->
          <div class="d-flex align-items-center mb-8">
            <!--begin::Symbol-->
            <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-gray svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-09-093151/theme/html/demo7/dist/../src/media/svg/icons/Communication/Clipboard-check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                    <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                  </g>
                </svg><!--end::Svg Icon--></span>
              </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div>
              <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">10</a>
              <div class="font-size-sm text-muted font-weight-bold mt-1">Completados en el mes</div>
            </div>
            <!--end::Title-->
          </div>
          <!--end::Widget Item-->
          <!--begin::Widget Item-->
          <div class="d-flex align-items-center mb-8">
            <!--begin::Symbol-->
            <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-gray svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-09-093151/theme/html/demo7/dist/../src/media/svg/icons/General/Clipboard.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                  </g>
                </svg><!--end::Svg Icon--></span>
              </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div>
              <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">5</a>
              <div class="font-size-sm text-muted font-weight-bold mt-1">Sin asignar</div>
            </div>
            <!--end::Title-->
          </div>
          <!--end::Widget Item-->
          <!--begin::Widget Item-->
          <div class="d-flex align-items-center">
            <!--begin::Symbol-->
            <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-lg svg-icon-gray-500">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Design/Layers.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"></rect>
                      <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
                      <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div>
              <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">2</a>
              <div class="font-size-sm text-muted font-weight-bold mt-1">En proceso</div>
            </div>
            <!--end::Title-->
          </div>
          <!--end::Widget Item-->
        </div>
        <!--end::Items-->
      </div>
      <!--end::Body-->
    </div>
  </div>
  <div class="col-lg-8 col-xl-7 tab-pane " id="card-4" role="tabpanel" aria-labelledby="card-4">
    <div class="card card-custom gutter-b card-stretch">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Mantenimientos a realizar</span>
        </h3>
        <div class="card-toolbar">
          <ul class="nav nav-pills nav-pills-sm nav-dark-75">
            <li class="nav-item">
              <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_5_1">Mes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_5_2">Semana</a>
            </li>
            <li class="nav-item">
              <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_5_3">Día</a>
            </li>
          </ul>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2 pb-0 mt-n3">
        <div class="tab-content mt-5" id="myTabTables5">
          <!--begin::Tap pane-->
          <div class="tab-pane active" id="kt_tab_pane_5_1" role="tabpanel" aria-labelledby="kt_tab_pane_5_1">
            <!--begin::Table-->
            <div class="table-responsive">
              <table class="table table-borderless table-vertical-center">
                <thead>
                  <tr>
                    <th class="p-0 min-w-150px"></th>
                    <th class="p-0 min-w-140px"></th>
                    <th class="p-0 min-w-110px"></th>
                    <th class="p-0 min-w-50px"></th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i=0; $i < 5; $i++)
                    <tr>
                      <td class="pl-0">
                        <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Preventivo XX</a>
                        <span class="text-muted font-weight-bold d-block"><span class="text-muted font-weight-bold mt-2 small">
                          <span class="mr-2">11/03/2021 - Insistencia realizada al Cliente</span>
                        </span></span>
                      </td>
                      <td class="text-right">
                        <span class="text-muted font-weight-500">11/03/2021</span>
                      </td>
                      <td class="text-right">
                        <div class="d-flex align-items-center py-lg-0 py-2">
                          <div class="d-flex flex-column text-right">
                            <span class="badge text-white bg-warning">
                              Pendiente Liberación
                            </span>
                          </div>
                        </div>
                      </td>
                      <td class="text-right pr-0">
                        <a href="{{route('panel.mantenimientos.preventivos.index')}}" class="btn btn-icon btn-light btn-sm">
                          <span class="svg-icon svg-icon-md svg-icon-success">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                        </a>
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Tap pane-->
          <!--begin::Tap pane-->
          <div class="tab-pane" id="kt_tab_pane_5_2" role="tabpanel" aria-labelledby="kt_tab_pane_5_2">
            <!--begin::Table-->
            <div class="table-responsive">
              <table class="table table-borderless table-vertical-center">
                <thead>
                  <tr>
                    <th class="p-0 min-w-150px"></th>
                    <th class="p-0 min-w-140px"></th>
                    <th class="p-0 min-w-110px"></th>
                    <th class="p-0 min-w-50px"></th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i=0; $i < 5; $i++)
                    <tr>
                      <td class="pl-0">
                        <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Preventivo XX</a>
                        <span class="text-muted font-weight-bold d-block"><span class="text-muted font-weight-bold mt-2 small">
                          <span class="mr-2">11/03/2021 - Insistencia realizada al Cliente</span>
                        </span></span>
                      </td>
                      <td class="text-right">
                        <span class="text-muted font-weight-500">11/03/2021</span>
                      </td>
                      <td class="text-right">
                        <div class="d-flex align-items-center py-lg-0 py-2">
                          <div class="d-flex flex-column text-right">
                            <span class="badge text-white bg-warning">
                              Pendiente Liberación
                            </span>
                          </div>
                        </div>
                      </td>
                      <td class="text-right pr-0">
                        <a href="#" class="btn btn-icon btn-light btn-sm">
                          <span class="svg-icon svg-icon-md svg-icon-success">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                        </a>
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Tap pane-->
          <!--begin::Tap pane-->
          <div class="tab-pane" id="kt_tab_pane_5_3" role="tabpanel" aria-labelledby="kt_tab_pane_5_3">
            <!--begin::Table-->
            <div class="table-responsive">
              <table class="table table-borderless table-vertical-center">
                <thead>
                  <tr>
                    <th class="p-0 min-w-150px"></th>
                    <th class="p-0 min-w-140px"></th>
                    <th class="p-0 min-w-110px"></th>
                    <th class="p-0 min-w-50px"></th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i=0; $i < 5; $i++)
                    <tr>
                      <td class="pl-0">
                        <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Preventivo XX</a>
                        <span class="text-muted font-weight-bold d-block"><span class="text-muted font-weight-bold mt-2 small">
                          <span class="mr-2">11/03/2021 - Insistencia realizada al Cliente</span>
                        </span></span>
                      </td>
                      <td class="text-right">
                        <span class="text-muted font-weight-500">11/03/2021</span>
                      </td>
                      <td class="text-right">
                        <div class="d-flex align-items-center py-lg-0 py-2">
                          <div class="d-flex flex-column text-right">
                            <span class="badge text-white bg-warning">
                              Pendiente Liberación
                            </span>
                          </div>
                        </div>
                      </td>
                      <td class="text-right pr-0">
                        <a href="#" class="btn btn-icon btn-light btn-sm">
                          <span class="svg-icon svg-icon-md svg-icon-success">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                        </a>
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Tap pane-->
        </div>
      </div>
      <!--end::Body-->
    </div>
  </div>

  <div class="col-lg-6 col-xl-4 tab-pane " id="card-5" role="tabpanel" aria-labelledby="card-5">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Tickets Abiertos</span>
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-primary">
                Prioridad Baja
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-warning">
                Prioridad Media
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>
  <div class="col-lg-6 col-xl-4 tab-pane " id="card-5" role="tabpanel" aria-labelledby="card-5">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Tickets con Espera de Diagnóstico</span>
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-primary">
                Prioridad Baja
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-warning">
                Prioridad Media
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>
  <div class="col-lg-6 col-xl-4 tab-pane " id="card-5" role="tabpanel" aria-labelledby="card-5">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Tickets con Espera de Repuestos</span>
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-primary">
                Prioridad Baja
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-warning">
                Prioridad Media
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>
  <div class="col-lg-6 col-xl-4 tab-pane " id="card-5" role="tabpanel" aria-labelledby="card-5">
    <div class="card card-custom card-stretch gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Tickets Pendientes</span>
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-primary">
                Prioridad Baja
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end::Item-->
        <!--begin: Item-->
        <div class="d-flex flex-wrap align-items-center mb-10">
          <!--begin::Title-->
          <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">ventas</a>
            <span class="text-muted font-weight-bold mt-2 small">
              <span class="mr-2"><i class="far fa-building"></i> Cliente 1</span>
              <span class="mr-2"><i class="far fa-calendar-alt"></i> 15/04/2020</span>
            </span>
          </div>
          <!--end::Title-->
          <!--begin::Info-->
          <div class="d-flex align-items-center py-lg-0 py-2">
            <div class="d-flex flex-column text-right">
              <span class="badge text-white bg-warning">
                Prioridad Media
              </span>
            </div>
          </div>
          <!--end::Info-->
        </div>
        <!--end: Item-->

      </div>
      <!--end::Body-->
    </div>
  </div>

  <div class="col-lg-12 col-xl-12 tab-pane " id="card-6" role="tabpanel" aria-labelledby="card-6">
    <div class="card card-custom gutter-b">
      <!--begin::Header-->
      <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Disponibilidad</span>
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
          <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
            <thead>
              <tr class="text-left">
                <th style="min-width: 200px">Técnicos</th>
                <th style="min-width: 150px">Grupo</th>
                <th style="min-width: 150px">Ocupación</th>
                <th class="pr-0 text-right" style="min-width: 150px">Horario disponible</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pl-0">
                  <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Martín Alvarenga</a>
                  <span class="text-muted font-weight-bold text-muted d-block">Lorem ipsum</span>
                </td>
                <td>
                  <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Grupo 1</span>
                  <span class="text-muted font-weight-bold">Lorem ipsum</span>
                </td>
                <td>
                  <div class="d-flex flex-column w-100 mr-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                      <span class="text-muted mr-2 font-size-sm font-weight-bold">100%</span>
                      <span class="text-muted font-size-sm font-weight-bold">Ocupación</span>
                    </div>
                    <div class="progress progress-xs w-100">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td class="pr-0 text-right">
                  <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Sin horario disponible</span>
                </td>
              </tr>
              <tr>

                <td class="pl-0">
                  <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Gustavo Ayala</a>
                  <span class="text-muted font-weight-bold text-muted d-block">Lorem ipsum</span>
                </td>
                <td>
                  <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Grupo 2</span>
                  <span class="text-muted font-weight-bold">Lorem ipsum</span>
                </td>
                <td>
                  <div class="d-flex flex-column w-100 mr-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                      <span class="text-muted mr-2 font-size-sm font-weight-bold">83%</span>
                      <span class="text-muted font-size-sm font-weight-bold">Ocupación</span>
                    </div>
                    <div class="progress progress-xs w-100">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 83%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td class="pr-0 text-right">
                  <span class="text-dark-75 font-weight-bolder d-block font-size-lg">13.00 a 15.00</span>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!--end::Table-->
      </div>
      <!--end::Body-->
    </div>
  </div>

</div>
