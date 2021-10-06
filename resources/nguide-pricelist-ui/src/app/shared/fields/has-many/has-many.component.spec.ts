import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HasManyComponent } from './has-many.component';

describe('HasManyComponent', () => {
  let component: HasManyComponent;
  let fixture: ComponentFixture<HasManyComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HasManyComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(HasManyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
