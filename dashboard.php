<?php
include_once "header.php";
?>

<div class="container mt-5 pb-3">
  <h3>Progress</h3>
  <h4> (Total Tasks:  <?php
  echo " " . count($_SESSION["todo"]) . ")";
  ?></h4>
 
  <div class=" task-info">
    <div class="completed-tasks">

    </div>
    <span>In Progress</span>


    <div class="in-progress">

    </div>
    <span>Completed</span>
  </div>

    <?php
    $count = count($_SESSION["todo"]);
    if(!$count == 0)
    {

  
    $completed = 0 ;
    $inprogress = 0;
    foreach($_SESSION["todo"] as $todo)
    {
      if($todo["is_done"] == 1)
      {
        $completed++;
      }
      if($todo["is_done"] == 0)
      {
        $inprogress++;
      }
    }


    $completed = ($completed/$count)*100;
    $inprogress = ($inprogress/$count)*100;
    // So, my total is count

    // echo $count;
    echo '   <div class="progress"><div class="progress-bar" role="progressbar" style="width: '.$completed . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-success" role="progressbar" style="width: '.$inprogress . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>
';
echo "<h5 class='mt-2'>In Progess: $inprogress%</h5>";
echo "<h5>Completed: $completed%</h5>";
}
?>


  <div class="container my-5 urgent-tasks">
  <hr>
    <h2>Urgent Tasks</h2>
    <span>1 - Normal, 2 - Important, 3 - Very Important</span>
    <div class="container">
      <div class="row my-5">
        <?php
        foreach ($_SESSION["sorted"] as $sorted) {
          // Check whether urgent task is done.
          if (!$sorted["is_done"]) {
            $d1 = date_create((string)$sorted["due_date"]);
            $d2 = new DateTime();
            $d2 = date_create($d2->format('Y-m-d H:i:s'));
            $current = date_diff($d2, $d1);
            echo '  
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">' . $sorted["title"] . '</h5>
                <p class="card-text">' . $sorted["description"] . '</p>
                <p class="card-text">' . $current->format("%d") . ' Days Left!!</p>
                <p class="card-text">Urgency: ' . $sorted["urgency"] . '</p>
              </div>
            </div>
          </div>';
          }
        }
        ?>
      </div>
    </div>
  </div>



  <!-- End of Urgent Task -->

  <!-- Start of Incomplete Task -->
  <div class="container mt-5">

    <?php
    echo '<div class="alert alert-primary" role="alert">  Welcome! ' .  $_SESSION["firstName"] . " " . $_SESSION["lastName"] . ' </div>';
    ?>

    <h2 class="mt-5">To Do</h2>
    <div class="container d-flex justify-content-end">
      <div class="sort px-3">
        <a href="includes/sort.inc.php?sort=asc" class="btn btn-dark " name="asc">Sort Asc</a>
      </div>
      <div class="sort">
        <a href="includes/sort.inc.php?sort=desc" class="btn btn-dark" name="desc">Sort Desc</a>
      </div>
    </div>

    <h3>Incomplete Task</h3>

    <table class="table  table-hover">

      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Urgency</th>
          <th scope="col">Status</th>
          <th scope="col">Due Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>


        <?php

        foreach ($_SESSION["todo"] as $todo) {
          $d1 = date_create((string)$todo["due_date"]);
          $d2 = new DateTime();
          $d2 = date_create($d2->format('Y-m-d H:i:s'));
          $current = date_diff($d2, $d1);

          if (!$todo["is_done"]) {
            echo "<tr>";
            echo '<th scope="row">' . $todo["title"] . '</th>';
            echo '<th style="width:30%">' . $todo["description"] . '</th>';
            echo '<th>' . $todo["urgency"] . '</th>';
            if ($todo["is_done"] == 0) {
              echo '<th><span class="badge rounded-pill bg-primary">In Progress</span></th>';
            } else {
              echo '<th><span class="badge rounded-pill bg-success">Completed</span></th>';
            }

            echo '<th>' . $current->format("%d")  . ' Days Left</th>';
            echo '<th><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask' . $todo["todo_id"] . '"' . '>
        Edit Task
      </button></th>
      <th><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTask' . $todo["todo_id"] . '"' . '>
        Delete Task
      </button></th>
      ';
            echo "</tr>";


            echo '<div class="modal fade" id="editTask' . $todo["todo_id"] . '"' . ' tabindex="-1" aria-labelledby="addNewTodo" aria-hidden="true">
      <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="includes/editTask.inc.php">
              <div class="mb-3">
                <label for="title" class="col-form-label  fw-bolder">Title</label>
                <input type="text" class="form-control" name="title" value = "' . $todo["title"] . '"' . '>
              </div>
              <div class="mb-3">
                <label for="description" class="col-form-label  fw-bolder">Description</label>
                <textarea class="form-control" name="description">' . $todo["description"] . '</textarea>
              </div>
              <div class="mb-3">
                <label for="date" class="col-form-label  fw-bolder">Due Date</label>
                <input type="datetime-local" class="form-control" name="date" value = "' . $todo["due_date"] . '"' . ' required>
              </div>
              <div class="mb-3">
    
                <label for="urgency" class="col-form-label  fw-bolder">Urgency</label>
                <ul class="list-unstyled">
                  <li class="fw-normal">1-normal. 2-important, 3-very important</li>
                </ul>
                <input type="number" class="form-control" name="urgency" min="1" max="3" value = "' . $todo["urgency"] . '"' . '>
              </div>
              <div class="mb-3">
              <input type="boolean" class="form-control" name="todo_id"  value ="' . $todo["todo_id"] . '"style="display:none";>
              ';

        ?>
            <?php
            if ($todo["is_done"] == 0) {


              echo '
              <label for="is_done" class="col-form-label  fw-bolder">Is Done(Type: yes or no)</label>
              <input type="boolean" class="form-control" name="is_done"  value =No>
            </div>';
            } else {
              echo '
            <label for="is_done" class="col-form-label  fw-bolder">Is Done(Type: yes or no)</label>
            <input type="boolean" class="form-control" name="is_done"  value =Yes>';
            }
            echo '
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
    
            </form>
            
            ';

            ?>
        <?php echo '
          </div>
    
        </div>
      </div>
    </div>
    
    
    <div class="modal fade" id="deleteTask' . $todo["todo_id"] . '"' . ' tabindex="-1" aria-labelledby="addNewTodo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <form action="includes/deleteTask.inc.php" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Are you sure you want to delete this task?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste distinctio iure ex, reprehenderit alias cum?</p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <input type="number" class="form-control" name="todo_id" value = "' . $todo["todo_id"] . '"' . ' style="display:none">
        </form>
  </div>
</div>
    ';
          }
        }
        ?>

      </tbody>
    </table>

  </div>

  <!-- Completed Tasks -->
  <div class="container completed-task mt-5">

    <h2>Completed Tasks</h2>
    <table class="table  table-hover">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Urgency</th>
          <th scope="col">Status</th>
          <th scope="col">Due Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($_SESSION["todo"] as $todo) {
          $d1 = date_create((string)$todo["due_date"]);
          $d2 = new DateTime();
          $d2 = date_create($d2->format('Y-m-d H:i:s'));
          $current = date_diff($d2, $d1);

          if ($todo["is_done"]) {
            echo "<tr>";
            echo '<th scope="row">' . $todo["title"] . '</th>';
            echo '<th style="width:30%">' . $todo["description"] . '</th>';
            echo '<th>' . $todo["urgency"] . '</th>';
            echo '<th><span class="badge rounded-pill bg-success">Completed</span></th>';


            echo '<th>' . $current->format("%d")  . ' Days Ago</th>';
            echo '<th><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask' . $todo["todo_id"] . '"' . '>
        Edit Task
      </button></th>
      <th><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#completeDelete' . $todo["todo_id"] . '"' . '>
        Delete Task
      </button></th>
      ';
            echo "</tr>";


            echo '<div class="modal fade" id="editTask' . $todo["todo_id"] . '"' . ' tabindex="-1" aria-labelledby="addNewTodo" aria-hidden="true">
      <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="includes/editTask.inc.php">
              <div class="mb-3">
                <label for="title" class="col-form-label  fw-bolder">Title</label>
                <input type="text" class="form-control" name="title" value = "' . $todo["title"] . '"' . '>
              </div>
              <div class="mb-3">
                <label for="description" class="col-form-label  fw-bolder">Description</label>
                <textarea class="form-control" name="description">' . $todo["description"] . '</textarea>
              </div>
              <div class="mb-3">
                <label for="date" class="col-form-label  fw-bolder">Due Date</label>
                <input type="datetime-local" class="form-control" name="date" value = "' . $todo["due_date"] . '"' . ' required>
              </div>
              <div class="mb-3">
    
                <label for="urgency" class="col-form-label  fw-bolder">Urgency</label>
                <ul class="list-unstyled">
                  <li class="fw-normal">1-normal. 2-important, 3-very important</li>
                </ul>
                <input type="number" class="form-control" name="urgency" min="1" max="3" value = "' . $todo["urgency"] . '"' . '>
              </div>
              <div class="mb-3">
              <input type="boolean" class="form-control" name="todo_id"  value ="' . $todo["todo_id"] . '"style="display:none";>
              ';

        ?>
            <?php

            echo '
              <label for="is_done" class="col-form-label  fw-bolder">Is Done(Type: yes or no)</label>
              <input type="boolean" class="form-control" name="is_done">
            </div>';

            echo '
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
    
            </form>
            
            ';

            ?>
        <?php echo '
          </div>
    
        </div>
      </div>
    </div>
    
    
    <div class="modal fade" id="completeDelete' . $todo["todo_id"] . '"' . ' tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <form action="includes/deleteTask.inc.php" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Are you sure you want to delete this task?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste distinctio iure ex, reprehenderit alias cum?</p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <input type="number" class="form-control" name="todo_id" value = "' . $todo["todo_id"] . '"' . ' style="display:none">
        </form>
  </div>
</div>
    ';
          }
        }
        ?>

      </tbody>

    </table>
    <div class="container py-3">
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addNewTodo">Add New Todo</button>
  </div>
  </div>


  
  <div class="modal fade" id="addNewTodo" tabindex="-1" aria-labelledby="addNewTodo" aria-hidden="true">
    <div class="modal-dialog-centered modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="includes/todo.inc.php">
            <div class="mb-3">
              <label for="title" class="col-form-label  fw-bolder">Title</label>
              <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label  fw-bolder">Description</label>
              <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="mb-3">
              <label for="date" class="col-form-label  fw-bolder">Due Date</label>
              <input type="datetime-local" class="form-control" name="date">
            </div>
            <div class="mb-3">

              <label for="urgency" class="col-form-label  fw-bolder">Urgency</label>
              <ul class="list-unstyled">
                <li class="fw-normal">1-normal. 2-important, 3-very important</li>
              </ul>
              <input type="number" class="form-control" name="urgency" min="1" max="3">
            </div>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>
</div>

<?php
include_once "footer.php"
?>