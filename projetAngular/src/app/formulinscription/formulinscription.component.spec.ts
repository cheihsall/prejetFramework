import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormulinscriptionComponent } from './formulinscription.component';

describe('FormulinscriptionComponent', () => {
  let component: FormulinscriptionComponent;
  let fixture: ComponentFixture<FormulinscriptionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FormulinscriptionComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FormulinscriptionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
