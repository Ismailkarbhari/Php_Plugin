<div class="container-fluid" style="margin-top:30px !important;">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-9">
                    <h1>Media Types</h1>
                </div>
                <div class="col-md-3">
                    <button type="button" id="insert-btn" class="btn btn-primary" style="float: right;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="card mb-3" id="form-body">
                <div class="card-header">
                    Insert Data
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Media Type </label>
                            <input type="text" class="form-control" id="type" placeholder="Enter Media Type">
                        </div>
                        <div class="form-group">
                            <label>Book Type </label>
                            <input type="text" class="form-control" id="b_type" placeholder="Enter Book Type">
                        </div>
                        <div class="form-group mt-2">
                            <label>Media Url</label><br>
                            <input type="text" class="form-control" id="url" placeholder="Enter Media Url">
                            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
                        </div>
                        <!-- <div class="form-group mt-2">
                            <label>Media Url</label><br>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div> -->
                        <button name="ssubmit" type="submit" class="btn btn-primary mt-2" id="submit">Submit</button>
                    </form>
                </div>
            </div>
            <?php
             $key = 0;
             global $wpdb;
              $table_name = $wpdb->prefix . "mediatype"; 
              $result = $wpdb->get_results ( "SELECT * FROM ". $table_name );
            ?>
            <table id="tblUser">
                <thead>
                    <th>Id</th>
                    <th>Media Type</th>
                    <th>Book Type</th>
                    <th>Url</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php foreach( $result as $user) {
                    ?>
                        <tr>
                            <td><?php echo ++$key; ?><input type="hidden" class="state_id" value=<?php echo $user->id ?>></td>
                            <td><?php echo $user->m_type; ?></td>
                            <td class="b_t_td"><?php echo $user->book_type; ?></td>
                            <td class="url_td"><?php echo $user->media_url; ?><input type="hidden" class="state_id" value=<?php echo $user->media_url ?>></td>        
                            <td>
                                <a href="" class="btn btn-primary btn-sm sedit"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" id="<?php echo $user->id ?>" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                            
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--  -->

    <div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Update</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" class="form-control" id="id">
    <label>Media Type </label>
                            <input type="text" class="form-control" id="utype" placeholder="Enter Media Type">
                            </div>
                            <div class="form-group mt-2 pop_product">
                            <label class="blabel">Book Type </label>
                            <input type="text" class="form-control" id="btype" placeholder="Enter Book Type">
                            </div>
                            <div class="form-group mt-2 pop_product">
                            <label class="mlabel">Media Url</label><br>
                            <input type="text" class="form-control" id="uurl" placeholder="Enter Media Url">
                            </div>
                            <input type="button" name="upload-btn" id="upload-btn1" class="button-secondary" value="Upload Image">
    <div class="modal-footer">
    <button type="button" class="btn btn-primary supdate" data-dismiss="modal">Update</button>
      <button type="button" class="btn btn-primary close" data-dismiss="modal">Close</button>
    </div>
    
  </div>