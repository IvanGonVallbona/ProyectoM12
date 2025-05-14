import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CampanyaListComponent } from './campanya-list.component';

describe('CampanyaListComponent', () => {
  let component: CampanyaListComponent;
  let fixture: ComponentFixture<CampanyaListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [CampanyaListComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CampanyaListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
