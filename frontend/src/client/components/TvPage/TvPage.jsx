import React from 'react';
import CatalogItemLayout from '../CatalogItemLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Телевизоры',
                link: '/tvs'
            }
        ]);

        this.props.handleTvGet({
            brand: this.props.params.brand,
            model: this.props.params.model,
        });
    }

    render() {
        return (
            <div>
                <CatalogItemLayout {...this.props} item={this.props.tvs}/>
            </div>
        )
    }
}
