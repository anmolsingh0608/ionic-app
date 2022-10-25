import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor,
  HttpResponse,
  HttpErrorResponse,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { ToastService } from '../services/toast.service';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { UserRole } from '../models/user-role.model';

@Injectable()
export class HttpFailureInterceptor implements HttpInterceptor {
  constructor(
    private authService: AuthService,
    private toastService: ToastService,
    private router: Router
  ) {}

  intercept(
    request: HttpRequest<unknown>,
    next: HttpHandler
  ): Observable<HttpEvent<unknown>> {
    return next.handle(request).pipe(
      tap(
        (event: HttpEvent<any>) => {
          if (event instanceof HttpResponse) {
          }
        },
        (err) => {
          if (err.error.message) {
            this.toastService.present(err.error.message, 3000);
          }
          if (err instanceof HttpErrorResponse) {
            // if (this.authService.loginType === UserRole.ADMIN) {
            if (err.status === 401) {
              this.router.navigate(['/']);
            }
            if (err.status === 403) {
              this.router.navigate(['/']);
            }
            // }
            this.authService.clearToken();
          }
        }
      )
    );
  }
}
