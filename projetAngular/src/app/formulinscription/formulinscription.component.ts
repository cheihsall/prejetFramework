import { Hero } from './user';
import { Component } from '@angular/core';

@Component({
  selector: 'app-formulinscription',
  templateUrl: './formulinscription.component.html',
  styleUrls: ['./formulinscription.component.scss']
})
export class FormulinscriptionComponent {

  public user!: Hero;

  roles = ['Admin', 'User'];

  model = new Hero();

  submitted = false;

  onSubmit() { this.submitted = true; }

  newHero() {

  }
  
}


