
    public function profile(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'user' => $user
        ];

        $this->view('users/profile', $data);
    }

    public function changePassword(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'current_password' => trim($_POST['current_password']),
                'new_password' => trim($_POST['new_password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'current_password_err' => '',
                'new_password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate current password
            if(empty($data['current_password'])){
                $data['current_password_err'] = 'Please enter current password';
            }

            // Validate new password
            if(empty($data['new_password'])){
                $data['new_password_err'] = 'Please enter new password';
            } elseif(strlen($data['new_password']) < 6){
                $data['new_password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['new_password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Get user data to verify current password
            $user = $this->userModel->getUserById($_SESSION['user_id']);
            
            // Verify current password
            if(!password_verify($data['current_password'], $user->password)){
                $data['current_password_err'] = 'Current password is incorrect';
            }

            // Make sure errors are empty
            if(empty($data['current_password_err']) && empty($data['new_password_err']) && empty($data['confirm_password_err'])){
                // Hash password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);

                // Update password
                if($this->userModel->updatePassword($_SESSION['user_id'], $data['new_password'])){
                    flash('profile_message', 'Password changed successfully');
                    redirect('users/profile');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/changePassword', $data);
            }

        } else {
            $data = [
                'current_password' => '',
                'new_password' => '',
                'confirm_password' => '',
                'current_password_err' => '',
                'new_password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/changePassword', $data);
        }
    }
