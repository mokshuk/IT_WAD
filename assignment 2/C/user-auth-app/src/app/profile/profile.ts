import { Component } from '@angular/core';
import { CommonModule } from '@angular/common'; // Required for *ngIf
import { UserService } from '../user'; // Adjust path if needed
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [CommonModule, RouterModule], //
  templateUrl: './profile.html',
  styleUrl: './profile.css'
})
export class Profile {
  currentUser: any;

  constructor(private userService: UserService) {
    // This fetches the object we saved during registration
    this.currentUser = this.userService.getUserData(); 
  }
}