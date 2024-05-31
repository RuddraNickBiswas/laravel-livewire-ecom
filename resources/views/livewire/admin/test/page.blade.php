<div> <!-- Initialize Alpine.js with showModal state -->

    <x-admin.layouts.breadcrumb pre='Admin'
        now='Test' />

        <div class="card">
            <h5 class="card-header">Table Basic</h5>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Phone</th>
                    <th>Descrpition</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($tests as $test)
                    <tr>
                      <td>
                       {{ $test->title }}
                      </td>
                      <td>{{ $test->phone }}</td>

                      <td><span class="badge bg-label-primary me-1">Active</span></td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="javascript:void(0);">
                                <x-modal>
                                    <x-modal.open>
                                        <i class="ti ti-pencil me-1"></i> Edit</a>
                                    </x-modal.open>
                                    <x-modal.panel>
                                        <h1>Edit Dialouge Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste, ratione earum tempora odit voluptatibus labore sed molestiae officia illo excepturi animi eaque ea fugiat cum totam temporibus sunt, nisi error.</h1>
                                        <input type="text" class="form-control">
                                        <x-modal.footer>
                                            <h4>footer xl</h4>
                                        </x-modal.footer>
                                    </x-modal.panel>

                                </x-modal>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>


    <!-- Button trigger modal -->

    <!-- Modal -->

</div>
