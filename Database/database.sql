CREATE TABLE [game] (
  [id] integer PRIMARY KEY,
  [title] nvarchar(255),
  [description] nvarchar(255),
  [content] text,
  [vertical_img] nvarchar(255),
  [horizontal_img] nvarchar(255),
  [video] nvarchar(255),
  [player] nvarchar(255),
  [place] nvarchar(255),
  [favourite] integer
)
GO

CREATE TABLE [favourite] (
  [id_user] integer,
  [id_game] integer
)
GO

CREATE TABLE [user] (
  [id] integer PRIMARY KEY,
  [username] nvarchar(255),
  [email] nvarchar(255),
  [password] nvarchar(255),
  [created_at] timestamp
)
GO

CREATE TABLE [blog] (
  [id] integer PRIMARY KEY,
  [title] nvarchar(255),
  [post_img] nvarchar(255),
  [body] text,
  [created_at] timestamp
)
GO

CREATE TABLE [contact] (
  [id] integer PRIMARY KEY,
  [first_name] nvarchar(255),
  [last_name] nvarchar(255),
  [email] nvarchar(255),
  [content] text
)
GO

ALTER TABLE [favourite] ADD FOREIGN KEY ([id_user]) REFERENCES [user] ([id])
GO

ALTER TABLE [favourite] ADD FOREIGN KEY ([id_game]) REFERENCES [game] ([id])
GO
