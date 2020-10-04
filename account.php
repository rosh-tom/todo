        <?php include('inc/header.php'); ?> 
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <title>TODO</title>
    </head>
<body> 
<div class="container">  
    <?php include('inc/nav.php'); ?> 
    <?php 
        require_once('database/connection.php');
        $sqlQuery = "select * from tbl_users where id = ". $_SESSION['id'];
        $result = $conn->query($sqlQuery);
        $row = $result->fetch_assoc();        
     ?>

    <div id="account" v-cloak>  
        <div class="row">
            <div class="col-sm-12">
                <a href="home.php" class="btn btn-success" style="margin-top: 10px; margin-bottom: 10px;"> &#8249; Back </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Account Information  
                        <button 
                            class="btn btn-default btn-sm pull-right" 
                            style="margin-top: -5px;" 
                            v-on:click="changeMyPass"
                            > Change Password
                        </button>
                    </div>
                    <div class="panel-body"> 
                        <div class="col-sm-3">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" disabled value="<?= $row['firstname'] ?>" />
                        </div>     
                        <div class="col-sm-3">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" disabled value="<?= $row['lastname'] ?>" />
                        </div>                
                        <div class="col-sm-4">
                            <label for="">Email</label>
                            <input type="text" class="form-control" disabled value="<?= $row['email'] ?>" />
                        </div>  
                        <div class="col-sm-2">  
                            <button 
                                class="btn btn-primary"  
                                v-on:click="changeMyPass"
                                style="width: 100%; margin-top: 25px"
                                > Edit
                            </button>
                        </div> 
                    </div>
                </div>  
            </div>
        </div>
         
 
   

        <div class="row">
            <div class="col-sm-12"> 
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Achieved Todo List 
                    </div>
                    <div class="panel-body"> 
                        <div class="table-responsive">
                            <table class="table table-hover" style="margin-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th>Added</th>
                                        <th>Finished</th>
                                        <th>Todo</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="row in allMyTodo" v-cloak> 
                                        <td v-if="row.todo == 'Empty'" colspan="4" ><center>{{ row.todo }}</center></td> 
                                        <td v-if="row.todo != 'Empty'" >{{ row.created_at }}</td> 
                                        <td v-if="row.todo != 'Empty'" >{{ row.updated_at }}</td> 
                                        <td v-if="row.todo != 'Empty'" >{{ row.todo }}</td> 
                                        <td v-if="row.todo != 'Empty'" ><a class="text-danger hoverMe" v-on:click="deleteMyTodo(row.id)"> <b> &times; </b>  </a></td>  
                                    </tr>  
                                </tbody> 
                            </table>  
                        </div>
                    </div>
                    <div class="panel-footer">
                    <center>
                    <ul class="pagination">
                        <li v-if="page!=1">
                        <a aria-label="Previous" v-on:click="fetchMyTodo((page)-1)"><span aria-hidden="true">&laquo;</span></a></li>

                        <li v-for = "n in numberOfPages"
                            class="page-item"  
                        >
                            <a  
                                class="page-link" v-on:click="fetchMyTodo(n)" >{{ n }}
                            </a>
                            <!-- 
                                v-if="(page == n)"
                                disabled 
                                
                                <a 
                                v-else="(page != n)"
                                class="page-link hoverMe" v-on:click="fetchMyTodo(n)">{{ n }}
                            </a> -->
                             
                        </li>
                         

                        <li v-if="page<numberOfPages">
                        <a href="#" v-on:click="fetchMyTodo((page)+1)"><span aria-hidden="true">&raquo;</span></a>
                        </li>
                    </ul>
                    </center> 
                    </div>
                </div>  
            </div>
        </div> 
        

        <div v-if="changePassword">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" v-on:click="changePassword=false">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                            </div>
                            <div class="modal-body"> 
                                <input 
                                    class="form-control" 
                                    placeholder="Old Password" 
                                    style="margin-bottom: 3px;"
                                />  

                                <input 
                                    class="form-control" 
                                    placeholder="New Password" 
                                    style="margin-bottom: 3px;"
                                />   

                                <input 
                                    class="form-control" 
                                    placeholder="Confirm New Password" 
                                    style="margin-bottom: 3px;"
                                /> 
                                <div 
                                    class='alert alert-danger' 
                                    style="padding: 5px; margin-top: 10px; margin-bottom: 2px;"
                                    >hello world
                                </div>
                                
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div v-if="editAccount">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" v-on:click="editAccount=false">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                            </div>
                            <div class="modal-body"> 
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="First Name" 
                                    style="margin-bottom: 3px;"
                                /> 

                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Last Name" 
                                    style="margin-bottom: 3px;"
                                />  

                                <input 
                                    type="email"
                                    class="form-control" 
                                    placeholder="Email" 
                                    style="margin-bottom: 3px;"
                                />   

                                <input 
                                    type="password"
                                    class="form-control" 
                                    placeholder="Enter Your Password" 
                                /> 
                                <div 
                                    class='alert alert-danger' 
                                    style="padding: 5px; margin-top: 10px;"
                                    >hello world
                                </div>

                            <div class="modal-footer" style="margin-top: 10px;">
                                <button 
                                    type="button" 
                                    class="btn btn-success btn-sm"
                                    >Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  


    </div>
    <!-- #account  -->
</div>  
<!-- .container  -->
<script>
    var app = new Vue({
        el: '#account',
        data: {
            allMyTodo : '',
            changePassword: false,
            editAccount: false,
            page: 1,
            numPage: 10,
            numberOfPages: ''
        },
        methods: {
            fetchMyTodo: function(page){
                axios.post('actions/account.php', {
                    action: 'myTodos', 
                    myPage: page,  
                    numPage: this.numPage
                }).then(function(response){  
                    app.allMyTodo = response.data.data;  
                    app.numberOfPages = response.data.numberOfPages;  
                    app.page = response.data.page;
                    console.log(response.data.id);
                }); 
            },
            deleteMyTodo: function(id){ 
                if (confirm('Are you sure you want to save this thing into the database?')) {
                    axios.post('actions/account.php', {
                        action: 'deleteTodo',
                        id: id
                        }).then(function(response){
                            console.log(app.page);
                            app.fetchMyTodo(app.page);
                        }
                    );
                }  
               
            },
            changeMyPass: function(){
                app.changePassword = true;
            },
            func_editAccount: function(){
                app.editAccount = true;
            },
            // alertMe: function(){ 
            //     page = new URL(location.href).searchParams.get('page');
            //     if(!page){
            //         page = 1;
            //     }  
            //     alert(page);
            // }
        }, 
        created: function(){ 
            this.fetchMyTodo(this.page);
        }

    });

</script> 

<?php include('inc/footer.php'); ?>
 