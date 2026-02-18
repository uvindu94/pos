<?php
class Categories extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->categoryModel = $this->model('Category');
    }

    public function index(){
        // Pagination logic
        $limit = 10;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $totalCategories = $this->categoryModel->getCategoriesCount();
        $categories = $this->categoryModel->getCategories($limit, $offset);
        $totalPages = ceil($totalCategories / $limit);

        $data = [
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalResults' => $totalCategories
        ];

        $this->view('categories/index', $data);
    }

    public function add(){
        // Admin only
        if(!isAdmin()){
            flash('category_message', 'Unauthorized access', 'alert alert-danger');
            redirect('categories');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'parent_id' => trim($_POST['parent_id']),
                'name_err' => ''
            ];

            if(empty($data['name'])){
                $data['name_err'] = 'Please enter category name';
            }

            if(empty($data['name_err'])){
                if($this->categoryModel->addCategory($data)){
                    flash('category_message', 'Category Added');
                    redirect('categories');
                } else {
                    die('Something went wrong');
                }
            } else {
                $parentCategories = $this->categoryModel->getParentCategories();
                $data['parentCategories'] = $parentCategories;
                $this->view('categories/add', $data);
            }

        } else {
            $parentCategories = $this->categoryModel->getParentCategories();

            $data = [
                'name' => '',
                'parent_id' => '',
                'parentCategories' => $parentCategories
            ];

            $this->view('categories/add', $data);
        }
    }

    public function edit($id){
        // Admin only
        if(!isAdmin()){
            flash('category_message', 'Unauthorized access', 'alert alert-danger');
            redirect('categories');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'parent_id' => trim($_POST['parent_id']),
                'name_err' => ''
            ];

            if(empty($data['name'])){
                $data['name_err'] = 'Please enter category name';
            }

            if(empty($data['name_err'])){
                if($this->categoryModel->updateCategory($data)){
                    flash('category_message', 'Category Updated');
                    redirect('categories');
                } else {
                    die('Something went wrong');
                }
            } else {
                $parentCategories = $this->categoryModel->getParentCategories();
                $data['parentCategories'] = $parentCategories;
                $this->view('categories/edit', $data);
            }

        } else {
            $category = $this->categoryModel->getCategoryById($id);
            $parentCategories = $this->categoryModel->getParentCategories();

            $data = [
                'id' => $id,
                'name' => $category->name,
                'parent_id' => $category->parent_id,
                'parentCategories' => $parentCategories
            ];

            $this->view('categories/edit', $data);
        }
    }

    public function delete($id){
        // Admin only
        if(!isAdmin()){
            flash('category_message', 'Unauthorized access', 'alert alert-danger');
            redirect('categories');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->categoryModel->deleteCategory($id)){
                flash('category_message', 'Category Removed');
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('categories');
        }
    }
}
