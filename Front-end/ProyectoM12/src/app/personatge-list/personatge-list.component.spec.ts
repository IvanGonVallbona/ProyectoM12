import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PersonatgeListComponent } from './personatge-list.component';

describe('PersonatgeListComponent', () => {
  let component: PersonatgeListComponent;
  let fixture: ComponentFixture<PersonatgeListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PersonatgeListComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PersonatgeListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
