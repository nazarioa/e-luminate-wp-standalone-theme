#!/bin/bash

source ./env

#
# WordPress Theme Deployment Script (Bash version)
#
# Uploads theme zip to server via SFTP, removes old version, and extracts new version
#
# Usage: ./deploy.sh [environment]
# Example: ./deploy.sh production

set -e  # Exit on error

# Configuration
DIST_DIR=$DIST_DIR

# Load configuration
case "$ENVIRONMENT" in
    production)
        HOST=$SSH_HOST
        PORT=$SSH_PORT
        USERNAME=$SSH_USERNAME
        REMOTE_PATH=SSH_REMOTE_THEME_PATH
        THEME_NAME=$THEME_NAME
        THEME_FILE_PATH=$2
        ;;
    *)
        echo "Error: Unknown environment '$ENVIRONMENT'"
        echo "Available environments: staging, production"
        exit 1
        ;;
esac

# Local zip file path
ZIP_FILE="$DIST_DIR/$THEME_FILE_PATH"

# Check if zip file exists
if [ ! -f "$ZIP_FILE" ]; then
    echo "Error: Zip file not found at $ZIP_FILE"
    echo "Please run your build script first."
    exit 1
fi

# Display deployment information
echo "=== WordPress Theme Deployment ==="
echo "Environment: $ENVIRONMENT"
echo "Host: $HOST"
echo "Theme: $THEME_NAME"
echo "Zip file: $ZIP_FILE"
echo ""

# Confirm deployment
read -p "Continue with deployment? [y/N]: " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "Deployment cancelled."
    exit 0
fi

# SSH connection string
SSH_CONN="$USERNAME@$HOST"
# SSH_OPTS=" -p $PORT"
SSH_OPTS=""

echo ""
echo "[1/5] Testing SSH connection..."
if ! ssh $SSH_OPTS -o ConnectTimeout=5 "$SSH_CONN" "echo 'Connection successful'" > /dev/null 2>&1; then
    echo "Error: Cannot connect to $HOST"
    exit 1
fi
echo "Connection successful!"

echo "[2/5] Uploading $THEME_FILE_PATH..."
scp $SSH_OPTS "$ZIP_FILE" "$SSH_CONN:$REMOTE_PATH/" || {
    echo "Error: Upload failed"
    exit 1
}
echo "Upload complete!"

echo "[3/5] Removing old theme directory..."
echo "$REMOTE_PATH/$THEME_NAME"
ssh $SSH_OPTS "$SSH_CONN" "rm -rf $REMOTE_PATH/$THEME_NAME" || {
    echo "Warning: Could not remove old theme directory (it may not exist)"
}
echo "Old theme removed."

echo "[4/5] Extracting new theme..."
ssh $SSH_OPTS "$SSH_CONN" "cd $REMOTE_PATH && unzip -q $THEME_FILE_PATH && rm $THEME_FILE_PATH" || {
    echo "Error: Failed to extract theme"
    exit 1
}
echo "Theme extracted successfully!"

echo "[5/5] Setting permissions..."
#ssh $SSH_OPTS "$SSH_CONN" "chown -R www-data:www-data '$REMOTE_PATH/$THEME_NAME' && chmod -R 755 '$REMOTE_PATH/$THEME_NAME'" || {
#    echo "Warning: Could not set permissions (you may need sudo access)"
#}

echo ""
echo "=== Deployment Complete! ==="
echo "Theme '$THEME_NAME' has been deployed to $ENVIRONMENT."
