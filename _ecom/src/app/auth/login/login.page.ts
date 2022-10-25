import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/shared/services/auth.service';
import { ToastService } from 'src/app/shared/services/toast.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  loginForm: FormGroup = new FormGroup({
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', Validators.required),
  });
  constructor(
    private toastService: ToastService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit() {}

  submit() {
    if (this.loginForm.invalid) {
      this.toastService.present('Please enter valid credentials', 2000);
      return;
    }

    this.authService
      .login(this.loginForm.value)
      .subscribe((res) => {
        this.authService.setData(res.data);
        this.router.navigate(['admin/dashboard']);
      });
  }
}
