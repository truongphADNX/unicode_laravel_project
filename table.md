Table categories {
  id int [pk, increment]
  name varchar(200)
  slug varchar(200)
  parent_id tinyint
  created_at timestamp
  updated_at timestamp
}

Table courses {
  id int
  name varchar(255)
  slug varchar(255)
  detail text
  teacher_id int
  thumbnail varchar(255)
  price float
  sale_price float
  code varchar(100)
  durations float
  is_document tinyint
  supports text
  status tinyint
  created_at timestamp
  updated_at timestamp
}

Table lessions {
  id int
  name varchar(255)
  slug varchar(255)
  video_id int
  document_id int
  parent_id int
  is_trial tinyint
  views int
  position int 
  duration float
  description text
  created_at timestamp
  updated_at timestamp
}

Table categories_courses {
  id int
  category_id int
  course_id int
  created_at timestamp
  updated_at timestamp
}

Table teachers{
  id int
  name varchar(255)
  slug varchar(255)
  description text
  exp float
  image varchar
  created_at timestamp
  updated_at timestamp
}

Table videos{
  id int
  name bvarchar(255)
  url varchar (255)
  created_at timestamp
  updated_at timestamp
}

Table documents{
  id int
  name varchar(255)
  url varchar(255)
  size float
  created_at timestamp
  updated_at timestamp
}

Table categories_posts {
  id int [pk, increment]
  name varchar(200)
  slug varchar(200)
  parent_id tinyint
  created_at timestamp
  updated_at timestamp
}

Table posts {
  id int
  title varchar(255)
  slug varchar(255)
  content text
  exceprt text
  thumbnail varchar(255)
  category_post_id int
  created_at timestamp
  updated_at timestamp
}

Table students {
  id int
  name varchar(100)
  email varchar(100)
  phone varchar(20)
  password varchar(100)
  address varchar(200)
  status tinyint
  reated_at timestamp
  updated_at timestamp
}

Table students_courses {
  id int
  course_id int
  student_id int
  created_at timestamp
  updated_at timestamp
}
Table orders{
  id int
  student_id int 
  total float
  status tinyint
  created_at timestamp
  updated_at timestamp
}

Table orders_detail{
  id int
  order_id int
  course_id int
  price float
  status tinyint
  created_at timestamp
  updated_at timestamp
}

Table orders_status {
  id int
  name varchar(100)
  created_at timestamp
  updated_at timestamp
}

Table users{
  id int
  name varchar(100)
  email varchar(100)
  password varchar(100)
  group_id int
  created_at timestamp
  updated_at timestamp
}

Table groups{
  id int
  name varchar(100)
  created_at timestamp
  updated_at timestamp
}


Table modules {
  id int
  name varchar(100)
  title varchar(200)
  role text
  created_at timestamp
  updated_at timestamp
}

Table options{
  id int
  name varchar
  value text
  created_at timestamp
  updated_at timestamp
}






























