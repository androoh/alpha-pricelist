import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PriceAssignComponent } from './price-assign.component';

describe('PriceAssignComponent', () => {
  let component: PriceAssignComponent;
  let fixture: ComponentFixture<PriceAssignComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PriceAssignComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PriceAssignComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
