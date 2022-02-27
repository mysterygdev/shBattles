@extends('layouts.ap.app')
@section('index', 'sendNotice')
@section('title', 'Add Product')
@section('zone', 'AP')
@section('content')
  @include('partials.ap.nav')
  @include('partials.ap.header')
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          {{-- is logged in and is staff --}}
          @if($data['user']->isAuthorized())
            {{-- is adm, gm or gma --}}
            @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Add Product</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['addProduct']->checkErrors()))
                              <!-- TODO: SHOW ALL ERRORS, NOT JUST ONE -->
                              {{-- Errors found. Please make sure you filled out all form inputs. --}}
                              @if (count($data['addProduct']->errors))
                                <ul>
                                @foreach ($data['addProduct']->errors as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                            @endif
                              {{$data['addProduct']->addProduct()}}
                            @else
                              no errors
                            @endif
                            {{-- {{$data['addProduct']->addProduct()}} --}}
                          @endif

                          <p>First select an image, and then fill out the rest of the information.</p>
                          <p>Only one Item id and count are required. fill out as many as you like to create a package product.</p>

                          <form method="post">
                            @php
                              //echo $data['addProduct']->getPagination();
                              echo $data['addProduct']->loadImages();
                            @endphp

                            <p id="response"></p>
                            {{-- <form id="form" action="">
                            </form> --}}
                            <br>
                            {{-- <button class="btn btn-sm btn-primary" name="btn2" id="btn2">Remove Last Product Input</button> --}}
                            {{-- <div class="form-group">
                              <!-- TODO: CREATE RANDOM PRODUCT CODE, FIRST CHECKING IF CODE EXISTS IN DATABASE EX: PROD_COD-->
                              <label for="ProductCode">Product Code</label>
                              <input type="text" class="form-control" id="ProductCode" name="ProductCode" aria-describedby="ProductCode" placeholder="Enter product code">
                              <small id="ProductCode" class="form-text text-muted">Special Identifier for product</small>
                            </div> --}}
                            <div class="form-group">
                              <label for="ProductName">Product Name</label>
                              <input type="text" class="form-control" id="ProductName" name="ProductName" aria-describedby="ProductName" placeholder="Enter product name">
                              <small id="ProductName" class="form-text text-muted">Product Name</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductDesc">Product Description</label>
                              <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" aria-describedby="ProductDesc" placeholder="Enter product description">
                              <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCost">Product Cost</label>
                              <input type="text" class="form-control" id="ProductCost" name="ProductCost" aria-describedby="ProductCost" placeholder="Enter product cost">
                              <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCategory">Product Category</label>
                              @if (!empty((WEBMALL['categories'])))
                                <select name="category" class="form-control">
                                  <option value="n/a">Select a category..</option>
                                    @foreach (WEBMALL['categories'] as $id => $category)
                                      <option value="{{$id}}">{{$category}}</option>
                                    @endforeach
                                </select>
                                <small id="ProductCategory" class="form-text text-muted">Product Category</small>
                              @else
                                <p>
                                  It looks like there are no category options. Please make edits to the corresponding configuration file.
                                </p>
                              @endif
                            </div>
                            <div class="form-group">
                              <label for="ProductTag">Product Tag</label>
                              @if (!empty((WEBMALL['tags'])))
                                <select name="tag" class="form-control">
                                  <option value="n/a">Select a tag..</option>
                                  @foreach (WEBMALL['tags'] as $id => $tag)
                                    <option value="{{$id}}">{{$tag}}</option>
                                  @endforeach
                                </select>
                                <small id="ProductTag" class="form-text text-muted">Product Tag</small>
                              @else
                                It looks like there are no tag options. Please make edits to the corresponding configuration file.
                              @endif
                            </div>
                            <div class="formInput-Group" id="formInput-Group"></div>
                            @Separator(20)
                            <button type="button" class="btn btn-sm btn-primary" name="btn" id="btn">Add Product Input</button>
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Create Product</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @else
            {{redirect('/admin/auth/login')}}
          @endif
        </div>
      </div>
    </div>
  </div>
  <script>
      const btn = document.getElementById('btn');
      const form = document.getElementById('formInput-Group');
      let formInline = document.querySelector('.form-inline');
      let counter = 0
      btn.addEventListener('click', function() {
        addInput();
      }.bind(this));
      document.body.addEventListener("click", e => {
        //alert("wut");
        if(e.target.closest(".btn-danger")) {
          e.preventDefault();
          removeInput();
        }
      });

      function addInput() {
        counter++;
        // Create form inline div for product id
        const div = document.createElement("div");
        div.setAttribute('class', 'form-inline');
        div.id = 'form-inline'+counter;
        // Create column div for product id
        const div1 = document.createElement("div");
        div1.setAttribute('class', 'col-sm-3');
        // Create form group div for product id
        const div2 = document.createElement("div");
        div2.setAttribute('class', 'form-group');
        // Create label of Item ID for product id
        const label = document.createElement("label");
        label.htmlFor = 'ItemID' + counter;
        label.innerHTML = "Item ID " + counter;
        // Create input of Item ID for product id
        const input = document.createElement("input");
        input.id = 'ItemID' + counter;
        input.type = 'text';
        input.name = 'Products[Items][][ItemID' + counter + ']';
        input.setAttribute('class', 'form-control');
        input.placeholder = 'Enter product id';
        // Create column div for product count
        const div4 = document.createElement("div");
        div4.setAttribute('class', 'col-sm-3');
        div4.setAttribute('style', 'margin-left:10%;');
        // Create form group div for product count
        const div5 = document.createElement("div");
        div5.setAttribute('class', 'form-group');
        // Create label of Item Count for product id
        const label2 = document.createElement("label");
        label2.htmlFor = 'ItemCount' + counter;
        label2.innerHTML = "Item Count " + counter;
        // Create input of Item Count for product id
        const input2 = document.createElement("input");
        input2.id = 'ItemCount' + counter;
        input2.type = 'text';
        input2.name = 'Products[Items][][ItemCount' + counter + ']';
        input2.setAttribute('class', 'form-control');
        input2.placeholder = 'Enter product count';
        const div6 = document.createElement("div");
        div6.setAttribute('class', 'col-sm-3');
        div6.setAttribute('style', 'margin-left:5%;');
        const button = document.createElement("button");
        button.setAttribute('class', 'btn btn-danger');
        button.innerHTML = 'X';
        button.id = 'btn2';
        button.setAttribute('type', 'button');
        // Append all items/divs
        form.appendChild(div);
        div.appendChild(div1);
        div1.appendChild(div2);
        div2.appendChild(label);
        div2.appendChild(input);
        div.appendChild(div4);
        div4.appendChild(div5);
        div5.appendChild(label2);
        div5.appendChild(input2);
        div.appendChild(div6);
        div6.appendChild(button);
      }

      function removeInput() {
        //alert("??");
        if (counter > 0) {
          //document.getElementById("form-inline"+counter).remove();
          //document.getElementById("form-inline"+counter).remove();
          //alert("1");
          //document.getElementsByClassName("btn-danger").removeChild(document.getElementsByClassName("btn-danger").lastChild);
          //alert("2");
          //document.querySelector('.form-inline').remove();
          const formInline = document.querySelector('.form-inline');
          const btn = document.querySelector('.btn-danger');
          //formInline.remove();
          //btn.closest(".form-inline").remove();
          //formInline.parentNode.removeChild(element);
          //firstDiv.remove();
          /* var el = document.getElementById('btn2');
          var closestParent = el.parentNode.closest('.form-inline');
          console.log(closestParent); */
          // Get last form-inline class that was added
          const last = Array.from(
            document.querySelectorAll('.form-inline')
          ).pop();
          //console.log(last);
          // remove last class inputs
          last.remove();
          //alert("wut");
        } else {
          alert("error");
        }
      }
</script>
@endsection
