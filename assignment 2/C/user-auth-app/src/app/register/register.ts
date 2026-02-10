import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { UserService } from '../user';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './register.html',
  styleUrl: './register.css',
})
export class Register {
  constructor(private userService: UserService, private router: Router) {}

  getValues(val: any) {
    this.userService.setUserData(val); // Save to service
    console.log("User Registered:", val);
    this.router.navigate(['/login']); // Redirect to login
  }
}
